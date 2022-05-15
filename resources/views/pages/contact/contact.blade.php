@extends('layout')
@section('main_content')
<!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3834.0029359048767!2d108.14690661431682!3d16.065337443810748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219295757447b%3A0xcefd7fcc0d511dd1!2zMTc5IMSQLiBQaOG6oW0gTmjGsCBYxrDGoW5nLCBIb8OgIEtow6FuaCBOYW0sIExpw6puIENoaeG7g3UsIMSQw6AgTuG6tW5nIDU1MDAwMCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1651202414353!5m2!1svi!2s" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <!-- Map End -->
    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form>
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="contact_name" id="contact_name" placeholder="Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="contact_email" id="contact_email" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="contact_content" id="contact_content" placeholder="Message"></textarea>
                                    <button type="button" class="site-btn btn-contact">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection