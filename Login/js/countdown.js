// Set tanggal akhir flash sale (contoh: 24 jam dari sekarang)
const countDownDate = new Date();
countDownDate.setHours(countDownDate.getHours() + 4);

// Update countdown setiap 1 detik
const x = setInterval(function() {
    // Dapatkan waktu sekarang
    const now = new Date().getTime();
    
    // Hitung selisih waktu
    const distance = countDownDate - now;
    
    // Hitung jam, menit, detik
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Tampilkan hasil
    document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
    document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
    document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');
    
    // Jika waktu habis
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("hours").innerHTML = "00";
        document.getElementById("minutes").innerHTML = "00";
        document.getElementById("seconds").innerHTML = "00";
        document.querySelector(".flash-sale-header").innerHTML = "<h2>FLASH SALE SELESAI</h2>";
    }
}, 1000);