<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paper;
use App\Exam;
use App\Question;
use App\Subject;
use DB;
use PDF;
use Exception;
use App\Http\Requests\GeneratorRequest;
use Illuminate\Support\Facades\Redirect;

class QPaperGeneratorController extends Controller
{
    protected $question, $paper, $exam, $subject;

    public function __construct(Question $question, Paper $paper, Exam $exam, Subject $subject)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->paper = $paper;
        $this->exam = $exam;
        $this->subject = $subject;
    }

    public function index() {
        $exams = $this->exam->select("exams.id as eid", "e.name as exam_type", "semester", "date", "s.name as subject", "s.id as sid")
        ->leftJoin("exams_types as e", "e.id", "=", "exams.exam_type_id")
        ->leftJoin("subjects as s", "s.id", "=", "exams.subject_id")
        ->orderby('exams.date', 'DESC')->paginate(10);
        return view("papers.exam_lists")->with(compact('exams'));
    }

    /**
     * return add form page
     */
    public function add() {
        return view('papers.add');
    }


    /**
     * view question by exam_id
     * these are generated question in papers
     * list of only one subject
     */
    public function view(Request $request) {
        $subjects =  DB::raw("(SELECT id,name FROM subjects) as s");
        $questions = $this->paper
        ->select('papers.id as pid', 'q.id as qid', 'text', 'mark', 'diff_level', 's.name')
        ->leftJoin('questions as q', 'q.id', '=', 'papers.question_id' )
        ->leftJoin($subjects, 's.id', '=', 'q.subject_id')
        ->where('exam_id', $request->id)
        ->orderby('s.name')
        ->paginate(10);

        return view('papers.view_questions')->with(compact('questions'));
    }
    
    /**
     * add question to papers
     */
    public function generateQuestions(GeneratorRequest $request) {
        //assign variables
        $arr[] = null;
        $i = 0;

        //sort by subject
        $data = $this->question->select(DB::raw("SUM(mark) as total, id"))
        ->where([['diff_level','=',$request->diff_level], ['subject_id','=', $request->subject_id]])
        ->inRandomOrder()->limit($request->noOfQuestions)->groupby('id', 'mark')->get();

        //totalMarks = question_mark * no_of_question or addition of all question marks
        //get total existing marks already assigned and stored in database : papers
        $totalMark = $data[0]->total;

        //marks validation
        //check database if fm is not less than total marks assigned
        $exam = $this->exam->find($request->exam_id);
        $assignedMark = $totalMark + $request->mark;
        
        if ($assignedMark > $exam->fm) {
            $notification = array(
                'message' => 'Marks assigned is more than full marks by '.($exam->fm - $assignedMark),
                'alert-class' => 'alert-warning'
            );
         
            return Redirect::to('papers')->with($notification);
        }

        //insert all questions in papers
        foreach ($data as $question) {
            $arr['question_id'] = $question->id;
            $arr['exam_id'] = $request->exam_id;
            $this->paper->create($arr);
            $i++;
        }

        if ($i>0) {
            $notification = array(
                'message' => 'Data Successfully Stored!',
                'alert-class' => 'alert-success'
            );
         
            return Redirect::to('papers')->with($notification);
        } else {
            $notification = array(
                'message' => $errors->all(),
                'alert-class' => 'alert-danger'
            );

            return Redirect::to('papers')->with($notification);
        }
    }

    /**
     * export to pdf
     */
    public function exportToPdf(Request $request, $exam_id, $subject_id) {
        $semester = $request->semester;
     
        $sub = $this->subject->select("name","code")->find($subject_id);
        $subject = $sub->name;
        $course_code = $sub->code;
       
        $examDetails = $this->exam->find($exam_id);
        
        $q = $this->paper
        ->select('text','mark')
        ->leftJoin('exams as e','e.id','=','papers.exam_id')
        ->leftJoin('questions as q','q.id','=','papers.question_id')
        ->where('papers.exam_id', $exam_id)    
        ->get();
        
        
        if($q->count()>0){
            $pdf = PDF::loadView('papers.paper', compact(["examDetails","semester","course_code","q","subject"]));
  
            //return view("GeneratedQuestions::pdf")->with(compact(["examDetails","semester","course_code","q"]));
            return $pdf->download('paper.pdf');
        }else{
            return "There is no questions selected for this exam. please add question first then export to pdf.";
        }
    }

    public function delete($id){
        $data = $this->paper->find($id);
        if($data->delete()){
            $notification = array(
                'message' => 'Data Successfully Deleted!', 
                'alert-class' => 'alert-success'
            );
            
         
            return Redirect::to('papers.view_questions')->with($notification);
        }
        
    }

    
}
