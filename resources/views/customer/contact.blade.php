@extends('layouts.customer.index')

@section('js')
    <script>
        function openWhatsApp() {
            var name = document.querySelector('input[name="fullname"]').value;
            var email = document.querySelector('input[name="mail"]').value;
            var whatsappNumber = document.querySelector('input[name="whatsapp_number"]').value;
            var description = document.querySelector('input[name="description"]').value;

            if (name && email && whatsappNumber && description) {
                var url = "https://wa.me/6285767113554?text=Halo%20Bakarin%20Boss,%20saya%20" + name + "%0AEmail%3A%20" + email + "%0ANomor%20Telepon%3A%20" + whatsappNumber + "%0ADeskripsi%3A%20" + description;
                window.open(url, "_blank");
                window.history.back();
            } else {
                console.log(name, email, whatsappNumber, description);
                alert("Silakan lengkapi semua kolom sebelum mengirim pesan.");
            }
        }
    </script>
@endsection

@section('content')
    <!-- Contact Section start -->
    <section id="contact" class="contact">
        <h2><span>Kontak</span> Kami</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, tempore.</p>

        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.7897278742453!2d106.8829223763819!3d-6.158910293828278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5ca5fa65ff1%3A0xafe23d29167e2e69!2sBakarin%20Boss!5e0!3m2!1sid!2sid!4v1699441826589!5m2!1sid!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>

            <form>
                <div class="input-grup">
                    <i data-feather="user"></i>
                    <input type="text" name="fullname" placeholder="Nama" value="{{ old('name') }}" required />
                </div>
                <div class="input-grup">
                    <i data-feather="mail"></i>
                    <input type="email" name="mail" placeholder="E-mail" value="{{ old('email') }}" required />
                </div>
                <div class="input-grup">
                    <i data-feather="phone"></i>
                    <input type="text" name="whatsapp_number" placeholder="Nomor WhatsApp" value="{{ old('whatsapp_number') }}" required />
                </div>
                <div class="input-grup">
                    <i data-feather="message-circle"></i>
                    <input type="text" name="description" placeholder="Deskripsi" value="{{ old('description') }}" required />
                </div>
                <button type="button" class="btn" onclick="openWhatsApp()">Kirim Pesan</button>
            </form>
        </div>
    </section>
    <!-- Contact Section end -->
@endsection
