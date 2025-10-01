<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Slider;
use App\Models\WelcomeItem;
use App\Models\Feature;
use App\Models\CounterItem;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Faq;
use App\Models\BlogCategory;
use App\Models\Post;
use App\Models\Destination;
use App\Models\DestinationPhoto;
use App\Models\DestinationVideo;
use App\Models\Package;
use App\Models\PackageAmenity;
use App\Models\PackageItinerary;
use App\Models\PackagePhoto;
use App\Models\PackageVideo;
use App\Models\PackageFaq;
use App\Models\Amenity;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Wishlist;
use App\Models\Subscriber;
use App\Models\HomeItem;
use App\Models\AboutItem;
use App\Models\ContactItem;
use App\Models\TermPrivacyItem;
use App\Mail\Websitemail;
use Hash;
use Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FrontController extends Controller
{
    public function home(){
        $sliders = Slider::get();
        $welcome_item = WelcomeItem::where('id',1)->first();
        $features = Feature::get();
        $testimonials = Testimonial::get(); 
        $destinations = Destination::orderBy('view_count','desc')->get()->take(8);       
        $posts = Post::with('blog_category')->orderBy('id','desc')->get()->take(3);
        $packages = Package::with(['destination','package_amenities','package_itineraries','tours','reviews'])->orderBy('id','desc')->get()->take(3);

        return view('front.home',  compact('sliders', 'welcome_item', 'features', 'testimonials', 'posts', 'destinations', 'packages'));
    }

    public function about()
    {
        $welcome_item = WelcomeItem::where('id',1)->first();
        $features = Feature::get();
        $counter_item = CounterItem::where('id',1)->first();
        $about_item = AboutItem::where('id',1)->first();
        return view('front.about', compact('welcome_item', 'features', 'counter_item', 'about_item'));
    }

    public function contact()
    {
        $contact_item = ContactItem::where('id',1)->first();
        return view('front.contact', compact('contact_item'));
    }

    public function contact_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
        ], [
            'name.required'    => 'Ime je obavezno.',
            'email.required'   => 'Email adresa je obavezna.',
            'email.email'      => 'Unesite ispravnu email adresu.',
            'comment.required' => 'Poruka je obavezna.',
        ]);

        $admin = Admin::where('id',1)->first();

        $subject = "Poruka sa kontakt forme";
        $message = "<b>Ime:</b><br>".$request->name."<br><br>";
        $message .= "<b>Email:</b><br>".$request->email."<br><br>";
        $message .= "<b>Poruka:</b><br>".nl2br($request->comment)."<br>";

        \Mail::to($admin->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Vaša poruka je uspešno poslata. Uskoro ćemo vas kontaktirati.');
    }

    public function terms()
    {
        $term_privacy_item = TermPrivacyItem::where('id',1)->first();
        return view('front.terms', compact('term_privacy_item'));
    }

    public function privacy()
    {
        $term_privacy_item = TermPrivacyItem::where('id',1)->first();
        return view('front.privacy', compact('term_privacy_item'));
    }

    public function registration(){
        return view('front.registration');
    }

    public function registration_submit(Request $request){
        $request->validate([
            'name'            => 'required',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required',
            'retype_password' => 'required|same:password',
        ], [
            'name.required'             => 'Ime je obavezno.',
            'email.required'            => 'Email adresa je obavezna.',
            'email.email'               => 'Unesite ispravnu email adresu.',
            'email.unique'              => 'Ova email adresa je već registrovana.',
            'password.required'         => 'Lozinka je obavezna.',
            'retype_password.required'  => 'Potvrda lozinke je obavezna.',
            'retype_password.same'      => 'Lozinke se ne poklapaju.',
        ]);

        $token = hash('sha256',time());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->token = $token;
        $user->save();

        $verification_link = route('registration_verify',['email'=>$request->email,'token'=>$token]);

        $subject = 'Verifikacija korisničkog naloga';
        $message = 'Kliknite na sledeći link kako biste verifikovali svoju email adresu:<br><a href="'.$verification_link.'">Verifikuj email</a>';

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Registracija je uspešna! Da biste se prijavili, verifikujte email adresu – proverite pristiglu poštu.');
    }

    public function registration_verify($email,$token)
    {
        $user = User::where('token',$token)->where('email',$email)->first();
        if(!$user) {
            return redirect()->route('login')->with('error','Nevažeći verifikacioni link.');
        }
        $user->token = '';
        $user->status = 1;
        $user->update();

        return redirect()->route('login')->with('success', 'Email je uspešno verifikovan. Sada se možete prijaviti.');
    }

    public function login(){
        return view('front.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Email adresa je obavezna.',
            'email.email'       => 'Unesite ispravnu email adresu.',
            'password.required' => 'Lozinka je obavezna.',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
            'status' => 1,
        ];

        if(Auth::guard('web')->attempt($data)) {
            return redirect()->route('user_dashboard')->with('success','Uspešno ste se prijavili!');
        } else {
            return redirect()->route('login')->with('error','Pogrešni podaci! Pokušajte ponovo.')->withInput();
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success','Uspešno ste se odjavili!');
    }

    public function forget_password()
    {
        return view('front.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Email adresa je obavezna.',
            'email.email'    => 'Unesite ispravnu email adresu.',
        ]);

        $user = User::where('email',$request->email)->first();
        if(!$user) {
            return redirect()->back()->with('error','Email adresa nije pronađena!');
        }

        $token = hash('sha256',time());
        $user->token = $token;
        $user->update();

        $reset_link = route('reset_password',['token'=>$token,'email'=>$request->email]);
        $subject = "Resetovanje lozinke";
        $message = "Za resetovanje lozinke kliknite na sledeći link:<br>";
        $message .= "<a href='".$reset_link."'>Resetuj lozinku</a>";

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success','Poslali smo vam link za resetovanje lozinke na email.');
    }

    public function reset_password($token,$email)
    {
        $user = User::where('email',$email)->where('token',$token)->first();
        if(!$user) {
            return redirect()->route('login')->with('error','Token ili email nisu ispravni!');
        }
        return view('front.reset_password', compact('token','email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password'        => ['required'],
            'retype_password' => ['required','same:password'],
        ], [
            'password.required'        => 'Lozinka je obavezna.',
            'retype_password.required' => 'Potvrda lozinke je obavezna.',
            'retype_password.same'     => 'Lozinke se ne poklapaju.',
        ]);

        $user = User::where('email',$request->email)->where('token',$request->token)->first();
        $user->password = Hash::make($request->password);
        $user->token = "";
        $user->update();

        return redirect()->route('login')->with('success','Lozinka je uspešno resetovana. Sada se možete prijaviti.');
    }

    public function team_members()
    {
        $team_members = TeamMember::paginate(4);
        return view('front.team_members', compact('team_members'));
    }

    public function team_member($slug)
    {
        $team_member = TeamMember::where('slug',$slug)->first();
        return view('front.team_member', compact('team_member'));
    } 

    public function faq()
    {
        $faqs = Faq::get();
        return view('front.faq', compact('faqs'));
    }

    public function blog()
    {
        $posts = Post::with('blog_category')->orderBy('id','desc')->paginate(9);
        return view('front.blog', compact('posts'));
    }

    public function post($slug)
    {
        $categories = BlogCategory::orderBy('name','asc')->get();
        $post = Post::with('blog_category')->where('slug',$slug)->first();
        $latest_posts = Post::with('blog_category')->orderBy('id','desc')->get()->take(5);
        return view('front.post', compact('post', 'categories', 'latest_posts'));
    }

    public function category($slug)
    {
        $category = BlogCategory::where('slug',$slug)->first();
        $posts = Post::with('blog_category')->where('blog_category_id',$category->id)->orderBy('id','desc')->paginate(9);
        return view('front.category', compact('posts', 'category'));
    }

    public function destinations()
    {
        $destinations = Destination::orderBy('id','asc')->paginate(20);
        return view('front.destinations', compact('destinations'));
    }

    public function destination($slug)
    {
        $destination = Destination::where('slug',$slug)->first();
        $destination->view_count = $destination->view_count + 1;
        $destination->update();

        $destination_photos = DestinationPhoto::where('destination_id',$destination->id)->get();
        $destination_videos = DestinationVideo::where('destination_id',$destination->id)->get();

        $packages = Package::with(['destination','package_amenities','package_itineraries','tours','reviews'])->orderBy('id','desc')->where('destination_id',$destination->id)->get()->take(3);
        
        return view('front.destination', compact('destination', 'destination_photos', 'destination_videos', 'packages'));
    }

    public function packages(Request $request)
    {
        $form_name = $request->name;
        $form_min_price = $request->min_price;
        $form_max_price = $request->max_price;
        $form_destination_id = $request->destination_id;
        $form_review = $request->review;

        $destinations = Destination::orderBy('name','asc')->get();
        
        $packages = Package::with(['destination','package_amenities','package_itineraries','tours','reviews'])->orderBy('id','desc');

        if($request->name != '') {
            $packages = $packages->where('name','like','%'.$request->name.'%');
        }

        if($request->min_price != '') {
            $packages = $packages->where('price','>=',$request->min_price);
        }

        if($request->max_price != '') {
            $packages = $packages->where('price','<=',$request->max_price);
        }

        if($request->destination_id != '') {
            $packages = $packages->where('destination_id',$request->destination_id);
        }

        if($request->review != 'all' && $request->review != null) {
            $packages = $packages->whereRaw('total_score/total_rating = ?', [$request->review]);
        }

        $packages = $packages->paginate(6);

        return view('front.packages', compact('destinations', 'packages', 'form_name', 'form_min_price', 'form_max_price', 'form_destination_id', 'form_review'));
    }

    public function package($slug)
    {
        $package = Package::with('destination')->where('slug',$slug)->first();
        $package_amenities_include = PackageAmenity::with('amenity')->where('package_id',$package->id)->where('type','Include')->get();
        $package_amenities_exclude = PackageAmenity::with('amenity')->where('package_id',$package->id)->where('type','Exclude')->get();
        $package_itineraries = PackageItinerary::where('package_id',$package->id)->get();
        $package_photos = PackagePhoto::where('package_id',$package->id)->get();
        $package_videos = PackageVideo::where('package_id',$package->id)->get();
        $package_faqs = PackageFaq::where('package_id',$package->id)->get();
        $tours = Tour::where('package_id',$package->id)->get();
        $reviews = Review::with('user')->where('package_id',$package->id)->get();

        return view('front.package', compact('package', 'package_amenities_include', 'package_amenities_exclude', 'package_itineraries', 'package_photos', 'package_videos', 'package_faqs', 'tours', 'reviews'));
    }

    public function payment(Request $request)
    {
        // Provera da li je izabrana tura
        if(!$request->tour_id) {
            return redirect()->back()->with('error', 'Molimo izaberite turu.');
        }

        // Provera raspoloživih mesta
        $tour_data = Tour::where('id',$request->tour_id)->first();
        $total_allowed_seats = $tour_data->total_seat;

        if($total_allowed_seats != '-1') {
            $total_booked_seats = 0;
            $all_data = Booking::where('tour_id',$request->tour_id)->where('package_id',$request->package_id)->get();
            foreach($all_data as $data) {
                $total_booked_seats += $data->total_person;
            }
    
            $remaining_seats = $total_allowed_seats - $total_booked_seats;
    
            if($total_booked_seats+$request->total_person > $total_allowed_seats) {
                return redirect()->back()->with('error', 'Žao nam je! Dostupno je samo '.$remaining_seats.' mesta za ovu turu.');
            }
        }
        
        $user_id = Auth::guard('web')->user()->id;
        $package = Package::where('id',$request->package_id)->first();
        $total_price = $request->ticket_price * $request->total_person;

        if($request->payment_method == 'PayPal')
        {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal_success'),
                    "cancel_url" => route('paypal_cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $total_price
                        ]
                    ]
                ]
            ]);

            if(isset($response['id']) && $response['id'] != null) {
                foreach($response['links'] as $link) {
                    if($link['rel'] == 'approve') {
                        session()->put('total_person', $request->total_person);
                        session()->put('tour_id', $request->tour_id);
                        session()->put('package_id', $request->package_id);
                        session()->put('user_id', $user_id);
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('paypal_cancel');
            }
        }
        elseif($request->payment_method == 'Stripe')
        {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $package->name,
                            ],
                            'unit_amount' => $total_price*100,
                        ],
                        'quantity' => $request->total_person,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe_success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe_cancel'),
            ]);

            if(isset($response->id) && $response->id != ''){
                session()->put('total_person', $request->total_person);
                session()->put('tour_id', $request->tour_id);
                session()->put('package_id', $request->package_id);
                session()->put('user_id', $user_id);
                session()->put('paid_amount', $total_price);
                return redirect($response->url);
            } else {
                return redirect()->route('stripe_cancel');
            }
        }
        elseif($request->payment_method == 'Cash') 
        {
            $obj = new Booking;
            $obj->tour_id = $request->tour_id;
            $obj->package_id = $request->package_id;
            $obj->user_id = Auth::guard('web')->user()->id;
            $obj->total_person = $request->total_person;
            $obj->paid_amount = $request->ticket_price;
            $obj->payment_method = "Cash";
            $obj->payment_status = "Pending";
            $obj->invoice_no = time();
            $obj->save();

            return redirect()->back()->with('success', 'Plaćanje je na čekanju i biće odobreno nakon pregleda administratora.');
        }
    }

    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        
        if(isset($response['status']) && $response['status'] == 'COMPLETED') {
            $obj = new Booking;
            $obj->tour_id = session()->get('tour_id');
            $obj->package_id = session()->get('package_id');
            $obj->user_id = session()->get('user_id');
            $obj->total_person = session()->get('total_person');
            $obj->paid_amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $obj->payment_method = "PayPal";
            $obj->payment_status = 'Completed';
            $obj->invoice_no = time();
            $obj->save();

            session()->forget(['tour_id', 'package_id', 'user_id', 'total_person']);

            return redirect()->back()->with('success', 'Plaćanje je uspešno!');
        } else {
            return redirect()->route('paypal_cancel');
        }
    }

    public function paypal_cancel()
    {
        return redirect()->back()->with('error', 'Plaćanje je otkazano.');
    }

    public function stripe_success(Request $request)
    {
        if(isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            $obj = new Booking;
            $obj->tour_id = session()->get('tour_id');
            $obj->package_id = session()->get('package_id');
            $obj->user_id = session()->get('user_id');
            $obj->total_person = session()->get('total_person');
            $obj->paid_amount = session()->get('paid_amount');
            $obj->payment_method = "Stripe";
            $obj->payment_status = "Completed";
            $obj->invoice_no = time();
            $obj->save();

            return redirect()->back()->with('success', 'Plaćanje je uspešno!');

            unset($_SESSION['tour_id']);
            unset($_SESSION['package_id']);
            unset($_SESSION['user_id']);
            unset($_SESSION['total_person']);
            unset($_SESSION['paid_amount']);

        } else {
            return redirect()->route('stripe_cancel');
        }
    }

    public function stripe_cancel()
    {
        return redirect()->back()->with('error', 'Plaćanje je otkazano.');
    }

    public function enquery_form_submit(Request $request, $id)
    {
        $package = Package::where('id',$id)->first();
        $admin = Admin::where('id',1)->first();

        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'message' => 'required',
        ], [
            'name.required'    => 'Ime je obavezno.',
            'email.required'   => 'Email adresa je obavezna.',
            'email.email'      => 'Unesite ispravnu email adresu.',
            'phone.required'   => 'Broj telefona je obavezan.',
            'message.required' => 'Poruka je obavezna.',
        ]);

        $subject = "Upit za: ".$package->name;
        $message = "<b>Ime:</b><br>".$request->name."<br><br>";
        $message .= "<b>Email:</b><br>".$request->email."<br><br>";
        $message .= "<b>Telefon:</b><br>".$request->phone."<br><br>";
        $message .= "<b>Poruka:</b><br>".nl2br($request->message)."<br>";

        \Mail::to($admin->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Vaš upit je uspešno poslat. Uskoro ćemo vas kontaktirati.');
    }

    public function review_submit(Request $request)
    {
        $request->validate([
            'rating'  => 'required',
            'comment' => 'required',
        ], [
            'rating.required'  => 'Molimo ocenite paket (1–5).',
            'comment.required' => 'Molimo unesite komentar.',
        ]);

        $obj = new Review;
        $obj->user_id = Auth::guard('web')->user()->id;
        $obj->package_id = $request->package_id;
        $obj->rating = $request->rating;
        $obj->comment = $request->comment;
        $obj->save();

        $package_data = Package::where('id',$request->package_id)->first();
        $package_data->total_rating = $package_data->total_rating + 1;
        $package_data->total_score = $package_data->total_score + $request->rating;
        $package_data->update();

        return redirect()->back()->with('success', 'Uspešno ste ostavili recenziju!');
    }

    public function wishlist($package_id)
    {
        if(!Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'Molimo prijavite se da biste dodali stavku na listu želja.');
        }

        $user_id = Auth::guard('web')->user()->id;

        $check = Wishlist::where('user_id',$user_id)->where('package_id',$package_id)->count();
        if($check > 0) {
            return redirect()->back()->with('error', 'Ova stavka je već na vašoj listi želja.');
        }

        $wishlist = new Wishlist();
        $wishlist->user_id = $user_id;
        $wishlist->package_id = $package_id;
        $wishlist->save();

        return redirect()->back()->with('success', 'Stavka je dodata na vašu listu želja.');
    }

    public function subscriber_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'email.required' => 'Email adresa je obavezna.',
            'email.email'    => 'Unesite ispravnu email adresu.',
            'email.unique'   => 'Ova email adresa je već pretplaćena.',
        ]);

        $token = hash('sha256',time());

        $obj = new Subscriber;
        $obj->email = $request->email;
        $obj->token = $token;
        $obj->status = 'Pending';
        $obj->save();

        $verification_link = route('subscriber_verify',['email'=>$request->email,'token'=>$token]);

        $subject = 'Verifikacija pretplate';
        $message = 'Kliknite na sledeći link kako biste potvrdili svoju pretplatu:<br><a href="'.$verification_link.'">Potvrdi pretplatu</a>';

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Uspešno ste se prijavili na newsletter. Proverite email i potvrdite pretplatu.');
    }

    public function subscriber_verify($email,$token)
    {
        $subscriber = Subscriber::where('token',$token)->where('email',$email)->first();
        if(!$subscriber) {
            return redirect()->route('home')->with('error', 'Nevažeći verifikacioni link.');
        }
        $subscriber->token = '';
        $subscriber->status = 'Active';
        $subscriber->update();

        return redirect()->back()->with('success', 'Pretplata je uspešno potvrđena.');
    }
}
