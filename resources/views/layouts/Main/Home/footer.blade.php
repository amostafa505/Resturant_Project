  <!-- Contact Section -->
    <div id="contact" class="text-center">
        <div class="container">
            <div class="section-title text-center">
                <h2>Contact Form</h2>
                <hr>
                <p>Happy To Hear From You.</p>
            </div>
            <div class="col-md-10 col-md-offset-1">
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form name="sentMessage" id="contactForm"  action="{{route('contact.send')}}" method="Post" >
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name" >
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" >
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="msg" id="message" class="form-control" rows="4" placeholder="Message" ></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div id="success"></div>
                    <button type="submit" formaction="{{route('contact.send')}}"  class="btn btn-custom btn-lg">Send Message</button>
                </form>
            </div>
        </div>
    </div>


    <div id="footer">
        <div class="container text-center">
            <div class="col-md-4">
                <h3>Address</h3>
                <div class="contact-item">
                    <p>Alexandria . Egypt</p>
                </div>
            </div>
            <div class="col-md-4">
                <h3>Opening Hours</h3>
                <div class="contact-item">
                    <p>Mon-Thurs: 10:00 AM - 11:00 PM</p>
                    <p>Fri-Sun: 11:00 AM - 02:00 AM</p>
                </div>
            </div>
            <div class="col-md-4">
                <h3>Contact Info</h3>
                <div class="contact-item">
                    <p>Phone: 01223609881</p>
                    <p>Email: amostafa806@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center copyrights">
            <div class="col-md-8 col-md-offset-2">
                <div class="social">
                    <ul>
                        <li><a href="https://www.facebook.com/ahmed.mostafa.1671/"><i class="fa fa-facebook"></i></a></li>
                        {{-- <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li> --}}
                    </ul>
                </div>
                <p>&copy; 2016 Touché. All rights reserved. Designed by <a href="" rel="nofollow">Me</a></p>
            </div>
        </div>
    </div>