<footer class="bg-secondary text-gray-300 py-12 border-t-4 border-accent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo STIKESMU" class="w-10 h-10 object-contain">
                    <span class="text-white font-display font-bold text-xl tracking-tight">STIKESMU WONOSOBO</span>
                </div>
                <p class="text-sm leading-relaxed mb-4">
                    Mencetak tenaga kesehatan profesional, Islami, dan berdaya saing global.
                </p>
                <div class="text-sm space-y-1">
                    <p class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-accent shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <a href="https://maps.app.goo.gl/drc2VWLsLPs2htyw8" target="_blank" rel="noopener noreferrer" class="hover:text-accent transition">Jl. Lingkar Selatan KM. 02, Jogoyitnan, Wonosobo, Jawa Tengah</a>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-accent shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:stikesmuhammadiyahwsb@gmail.com" class="hover:text-accent transition">stikesmuhammadiyahwsb@gmail.com</a>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-accent shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="https://wa.me/62895385250680" target="_blank" rel="noopener noreferrer" class="hover:text-accent transition">Telepon/WA: 0895-3852-50680</a>
                    </p>
                </div>
            </div>
            
            <div>
                <h3 class="text-white font-display font-bold text-lg mb-4">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('pmb.jalur') }}" class="hover:text-accent transition duration-300 flex items-center gap-1.5"><span class="text-accent">›</span> PMB Online</a></li>
                    <li><a href="{{ route('pmb.status_check') }}" class="hover:text-accent transition duration-300 flex items-center gap-1.5"><span class="text-accent">›</span> Cek Status PMB</a></li>
                    <li><a href="https://siakad.stikesmuwsb.ac.id/" target="_blank" rel="noopener noreferrer" class="hover:text-accent transition duration-300 flex items-center gap-1.5"><span class="text-accent">›</span> SIAKAD</a></li>
                    <li><a href="/dokumen" class="hover:text-accent transition duration-300 flex items-center gap-1.5"><span class="text-accent">›</span> Perpustakaan & Dokumen</a></li>
                    <li><a href="https://pddikti.kemdiktisaintek.go.id/" target="_blank" rel="noopener noreferrer" class="hover:text-accent transition duration-300 flex items-center gap-1.5"><span class="text-accent">›</span> Pangkalan Data (PDDIKTI)</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-display font-bold text-lg mb-4">Jam Operasional</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex justify-between"><span>Senin - Kamis</span> <span class="font-semibold text-white">08:00 - 16:00</span></li>
                    <li class="flex justify-between"><span>Jumat</span> <span class="font-semibold text-white">08:00 - 15:00</span></li>
                    <li class="flex justify-between text-gray-400"><span>Sabtu - Minggu</span> <span class="text-accent font-semibold">Tutup</span></li>
                </ul>
            </div>
        </div>
        
        <div class="mt-12 pt-8 border-t border-gray-700 text-sm text-center flex flex-col md:flex-row justify-between items-center">
            <p>&copy; {{ date('Y') }} STIKES Muhammadiyah Wonosobo. Hak Cipta Dilindungi.</p>
            <div class="mt-4 md:mt-0 flex space-x-4">
                <a href="https://www.facebook.com/stikesmuwsb" target="_blank" rel="noopener noreferrer" class="hover:text-white transition">Facebook</a>
                <a href="https://www.instagram.com/official_stikesmuwsb" target="_blank" rel="noopener noreferrer" class="hover:text-white transition">Instagram</a>
                <a href="https://www.youtube.com/@stikesmuhammadiyahwonosobo" target="_blank" rel="noopener noreferrer" class="hover:text-white transition">YouTube</a>
            </div>
        </div>
    </div>
</footer>
