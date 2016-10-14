<?php
  
  //Lekcija4: Part 4 - Controller Basics [How to Build a Blog with Laravel 5 Series]
  // ovo je kontroler koji ce prikazivati staticne vjuove u aplikaciji
  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Mail;
use Session;

class PagesController extends Controller{


  // metod koji prikazuje vju welcome.blade.php koji prikazuje 4 najnovija posta i jos ponesto... ruta: '/' URL: http://blogg.dev/
  public function getIndex(){
    // Lekcija 21 : Part 21 - Query Builder [How to Build a Blog with Laravel Series]
    $posts = Post::orderBy('created_at', 'desc')->limit(4)->get(); // SELECT * FROM posts ORDER BY created_at DESC LIMIT 4
    return view('pages.welcome')->withPosts($posts);//posalji u vju welcome.blade.php folderr 'blogg\resources\views\pages' da prikaze
    
  } 

  
  // metod koji prikazuje vju about.blade.php
  public function getAbout(){
    // Lekcija4: Part 5 - Passing Data to a View [How to Build a Blog with Laravel 5 Series]
	  $first = 'Vlada'; // ime
	  $last = 'Sarac'; //prezime
	  $fullname = $first.' '.$last; // puno ime i prezime
	  $email = "vladasrac@hotmail.com";
	  $data = [];
	  $data['email'] = $email;
	  $data['fullname'] = $fullname;
    //return view('pages.about')->with("fullname", $full); // poslacemo puno ime i prezime u vju about.blade.php s tim sto ce se ono tamo zvati $fullname(prvi parametar with() metoda) a ne $full
    //return view('pages.about')->withFullname($fullname); // isto kao ovo gore salje $fullname u vju 
	  return view('pages.about')->withData($data); // salje array $data u kom su i $email i $fullname 
  }
  

  // metod koji prikazuje vju contact.blade.php
  public function getContact(){
    return view('pages.contact');
  }

  // Lekcija 40 : Part 40 - Sending Email from Contact Form [How to Build a Blog with Laravel 5 Series]
  // metod se poziva kad se submituje forma u contact.blade.php iz foldera 'blogg\resources\views\pages' koristi se ruta - 
  // - Route::post('contact', 'PagesController@postContact');
  public function postContact(Request $request){
    $this->validate($request, [  // prvo validacija unosa u formu u contact.blade.php
      'email' => 'required|email',
      'subject' => 'min:3',
      'message' => 'min:10'
    ]);
    // array koji cemo poslati u vju contact.blade.php iz foldera 'blogg\resources\views\emails' koji ce zapravo biti email
    $data = array(
      'email' => $request->email,
      'subject' => $request->subject,
      // VAZNO ne sme se dati naziv kljucu 'message' zato sto je to laravelova zasticena varijabla tako da cemo mi message zvati -
       // - bodyMessage
      'bodyMessage' => $request->message
    ); 
    // ovo je metod za slanje maila, ovde mu ubacujemo i $data array da bi mogli da mu pristupimo
    Mail::send('emails.contact', $data, function($message) use ($data){
      $message->from($data['email']);

      // ovo je obavezno da bi znao kome da salje mail , mogu ovde da napisem npr lacparacku@yahoo.com i onda ce tamo slati
      $message->to('vladasarac@hotmail.com');
      //$message->to('kantarion35@gmail.com');  // a mogu poslati poruku tj mail i samom sebi na kantarion35@gmail.com
      //$message->to('lacparacku@yahoo.com');
      
      $message->subject($data['subject']);
    });
    // na kraju success message i redirect
    Session::flash('success', 'Your Email was Sent!');// podesi poruku koju ce prikazati _messages.blade.php
    // redirectuj na pocetnu stranicu (on je ovo napisao return redirect->url('/') ali mi tako nije radilo pa sam prepravio da radi)
    return redirect('/'); 
  }


}


  













  
  
  
  
  
  
  
  
  
  
  
  
  









