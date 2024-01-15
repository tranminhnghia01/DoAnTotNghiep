<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\MailContact;
use App\Models\Contact;
use App\Models\Infomation;
use Illuminate\Http\Request;
use Mail;

class ContactController extends Controller
{
    public function index(){
        $contact = Infomation::find(1);

        return view('admin.contact.index')->with(compact('contact'));
    }

    public function update(Request $request){
        $contact = Infomation::find(1);
        $data = $request->all();
        // dd($data);
        if($contact){
            $contact->update($data);

        }else{
            Infomation::create($data);
        }

        return redirect()->back();
    }

    public function about(){
        $about = Contact::orderBy('created_at','ASC')->get();
        return view('admin.contact.list')->with(compact('about'));
    }

    public function about_reply(Request $request){
        $data = $request->all();
        $id = $request->id;
        $email = Contact::find($id);

        $output ='';

        $output .='
        <div class="modal fade" id="aboutReplyModel" tabindex="-1" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nội dung câu hỏi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                     <div class="col-sm-12">
                         <div style="display: flex; justify-content: space-between">
                                 <label for="">Họ tên</label>
                                 <p class="check-time">'.$email->contact_name.'</p>
                             </div>
                         <div style="display: flex; justify-content: space-between">
                             <label for="">Email</label>
                             <p class="check-date">'.$email->contact_email.'</p>
                         </div>

                         <div style="display: flex; justify-content: space-between">
                             <label for="">Vấn đề về</label>
                             <p class="check-date">'.$email->contact_subject.'</p>
                         </div>

                         <div style="display: flex; justify-content: space-between">
                             <label for="">Nội dung</label>
                             <p class="check-date">'.$email->contact_content.'</p>
                         </div>

                         <form>
                        <input type="hidden" name="_token" value="'.csrf_token().'" />
                        <input type="hidden" name="id" value="'.$email->id.'" />

                        <div style="display: flex; justify-content: space-between">
                                            <label for="">
                                                <span style="font-weight:800;color:black">Nội dung trả lời: </span>
                                            </label>
                                                 <textarea class="destroy-text contact_reply" id="contact_reply" name="contact-reply" rows="4" cols="50" style="outline: aliceblue;
                                                 border: 1px solid orange;padding:10px">'.$email->contact_reply.'</textarea>
                                        </div>

                    </div>
                   <div class="modal-footer">
                        <button id="btn-store-contact-reply" data-id="'.$email->id.'" class="btn btn-success rounded-pill px-4">
                            Save
                        </button>
                        <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">
                            Discard
                        </button>
                        </form>

                 </div>
            </div>
        </div>';
        echo $output;

    }

    public function store_about_reply(Request $request){
        $data = $request->all();
        $id = $request->id;

        $contact = Contact::find($id);
        // dd($contact);
        $contact_reply = $request->contact_reply;
        if($contact){
            $contact->update(['contact_reply'=>$contact_reply,'contact_status'=>0]);
            $msg = 'Phản hồi thành công';
            Mail::to('minhnghia11a1@gmail.com')->send(new MailContact($contact));
            $style ='success';
            echo 'Phản hồi thành công';
        }
    }

    public function destroy(Request $request){
        $id = $request->id;
        $contact = Contact::find($id);
        $contact->delete();
        echo "Xóa câu hỏi thành công";
    }
}
