@extends('user/masterPublic')

@section('title', 'Registrasi Mitra')

@section('main')
<!-- slider Area Start-->
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="/user/assets/img/hero/contact_hero.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Registrasi Mitra</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!-- ================ contact section start ================= -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Isi form registrasi di bawah ini!</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="/daftar/proses" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="nama_pengaju" id="nama_pengaju" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama Pengaju'" placeholder="Nama Pengaju">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="unit_usaha" id="unit_usaha" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Unit Usaha'" placeholder="Unit Usaha">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="form-control" name="sektor_usaha" id="sektor_usaha" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Sektor Usaha'" placeholder="Sektor Usaha">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="form-control" name="npwp" id="npwp" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'NPWP'" placeholder="NPWP">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="ktp_pengaju">Unggah KTP</label>
                                <input class="form-control-file" name="ktp_pengaju" id="ktp_pengaju" type="file" onfocus="this.placeholder = ''" onblur="this.placeholder = 'KTP'" placeholder="KTP" accept="application/pdf">
                                <p class="help-block">Format PDF, maks. 7MB!</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="laporan_keuangan">Unggah Laporan Keuangan</label>
                                <input class="form-control-file" name="laporan_keuangan" id="laporan_keuangan" type="file" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Laporan Keuangan'" placeholder="Laporan Keuangan" accept="application/vnd.ms-excel">
                                <p class="help-block">Format Excel, maks. 7MB!</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="sku">Unggah SKU</label>
                                <input class="form-control-file" name="sku" id="sku" type="file" onfocus="this.placeholder = ''" onblur="this.placeholder = 'SKU'" placeholder="SKU" accept="application/pdf">
                                <p class="help-block">Format PDF, maks. 7MB!</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm boxed-btn">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>Regol, Bandung.</h3>
                        <p>Soekarno-Hatta St No.442, Pasirluyu, Regol, Bandung City, West Java 40254</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                        <h3>+62-22-5202682</h3>
                        <p>Mon to Fri 9am to 6pm</p>
                    </div>
                </div>
                <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                        <h3>marketing@len.co.id</h3>
                        <p>Send us your query anytime!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================ contact section end ================= -->

<!-- Request Back Start -->
<div class="request-back-area section-padding30">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="request-content">
                    <h3>Siapkan Pertanyaan</h3>
                    <p>Anda dapat mengajukan pertanyaan terkait Program Kemitraan PT. Len Industri.</p>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-7">
                <!-- Contact form Start -->
                <div class="form-wrapper">
                    <form id="contact-form" action="/faq/send" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="form-box  mb-30">
                                    <input type="text" name="pertanyaan" id="pertanyaan" placeholder="Pertanyaan?" required>
                                </div>
                            </div>

                            <div class="col-lg-8 col-md-8 mb-30">
                                <div class="select-itms">
                                    <select name="kategori" id="kategori" required>
                                        <option value="">Kategori</option>
                                        <option value="Administrasi Kemitraan">Administrasi Kemitraan</option>
                                        <option value="Pengajuan Proposal">Pengajuan Proposal</option>
                                        <option value="Pendanaan">Pendanaan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <button type="submit" class="send-btn">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>     <!-- Contact form End -->
        </div>
    </div>
</div>
<!-- Request Back End -->
@endsection
