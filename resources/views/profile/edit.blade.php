<x-shop-layout title="Update Profile">

    <!-- Start Contact Area -->
    <section id="contact-us" class="contact-us section">
        <div class="container">
            <div class="contact-head">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>Udate your Profile</h2>
                            <p>There are many variations of passages of Lorem
                                Ipsum available, but the majority have suffered alteration in some form.</p>
                        </div>
                    </div>
                </div>
                <div class="contact-info">
                    <div class="row">
                        <div class="col-12">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                You have some errors
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="contact-form-head">
                                <div class="form-main">
                                    <form class="form" method="post" action="{{route('profile.update')}}">
                                        @csrf
                                        @method('patch')
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="first_name" type="text" value="{{old('first_name' , $user->profile->first_name)}}" placeholder="First Name" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="last name" type="text" value="{{old('last_name' , $user->profile->last_name)}}" placeholder="Last Name" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="email" type="email" value="{{old('email' , $user->email)}}" placeholder="Your Email" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <input name="birthday" type="date" value="{{old('birthday' , $user->profile->birthday)}}" placeholder="Birthday" required="required">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit" class="btn">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Contact Area -->

</x-shop-layout>