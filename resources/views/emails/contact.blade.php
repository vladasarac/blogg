
{{--Lekcija 40 : Part 40 - Sending Email from Contact Form [How to Build a Blog with Laravel 5 Series]--}}
{{--ovaj vju je zapravo mail koji user salje kad submituje formu u contact.blade.php iz foldera 'blogg\resources\views\pages'--}}
{{-- u tutorijalu je ovaj fajl malo drugaciji ,  nema veze sustina je ista... --}}

<h1>You Have a New Contact Via the Contact Form</h1>
<h3>{{ $subject }}</h3>
<div>
  {{ $bodyMessage }}
</div>

<p>Sent via {{ $email }}</p>


















