<?php
$title = 'Lúmina Dental - Centro Odontológico';
require __DIR__ . '/../layout/header.php';
?>

<section class="hero">
    <div class="hero-content">
        <span class="eyebrow">Sonrisas sanas, vidas felices</span>
        <h1>Tu salud dental en manos de especialistas</h1>
        <p>En Lúmina Dental ofrecemos atención integral, tecnología moderna y un trato cercano para cuidar la sonrisa de toda tu familia.</p>
        <div class="hero-actions">
            <a class="btn" href="index.php?controller=auth&action=login">Solicitar cita</a>
            <a class="btn btn-outline" href="#servicios">Ver servicios</a>
        </div>
    </div>
    <div class="hero-card" aria-label="Información de contacto">
        <span class="hero-card-icon">✦</span>
        <div>
            <strong>Atención integral</strong>
            <p>Diagnóstico y tratamientos personalizados.</p>
        </div>
    </div>
</section>

<section id="servicios" class="landing-section">
    <div class="section-heading">
        <span class="eyebrow">Nuestros servicios</span>
        <h2>Soluciones para cada etapa de tu sonrisa</h2>
        <p>Contamos con tratamientos preventivos, restauradores y estéticos diseñados para tu bienestar.</p>
    </div>

    <div class="services-grid">
        <article class="service-card">
            <div class="service-icon">01</div>
            <h3>Odontología general</h3>
            <p>Revisión, limpieza dental, prevención y tratamientos básicos para mantener una boca saludable.</p>
        </article>
        <article class="service-card">
            <div class="service-icon">02</div>
            <h3>Ortodoncia</h3>
            <p>Opciones para corregir la alineación de tus dientes y mejorar tu mordida con acompañamiento profesional.</p>
        </article>
        <article class="service-card">
            <div class="service-icon">03</div>
            <h3>Estética dental</h3>
            <p>Diseño de sonrisa, blanqueamiento y restauraciones estéticas con resultados naturales y seguros.</p>
        </article>
        <article class="service-card">
            <div class="service-icon">04</div>
            <h3>Endodoncia</h3>
            <p>Tratamientos especializados para conservar tus piezas dentales y aliviar molestias o infecciones.</p>
        </article>
        <article class="service-card">
            <div class="service-icon">05</div>
            <h3>Cirugía y extracción</h3>
            <p>Procedimientos sencillos y quirúrgicos realizados con precisión, cuidado y seguimiento.</p>
        </article>
        <article class="service-card">
            <div class="service-icon">06</div>
            <h3>Odontopediatría</h3>
            <p>Atención amable y especializada para cuidar la salud bucal de los más pequeños de la familia.</p>
        </article>
    </div>
</section>

<section id="nosotros" class="about-section">
    <div class="about-content">
        <span class="eyebrow">Sobre nosotros</span>
        <h2>Cuidado dental con enfoque humano</h2>
        <p>Somos un centro odontológico comprometido con ofrecer experiencias cómodas y tratamientos basados en diagnóstico responsable. Nuestro equipo combina experiencia clínica, tecnología y empatía para acompañarte en cada decisión.</p>
        <ul class="about-list">
            <li>Profesionales comprometidos con tu salud</li>
            <li>Planes de tratamiento personalizados</li>
            <li>Ambiente seguro, limpio y confortable</li>
        </ul>
    </div>
    <div class="about-highlight">
        <strong>Confianza</strong>
        <span>Una sonrisa a la vez</span>
        <p>Más que atender dientes, cuidamos personas.</p>
    </div>
</section>

<section class="contact-section">
    <div>
        <span class="eyebrow">Agenda tu visita</span>
        <h2>¿Listo para cuidar tu sonrisa?</h2>
    </div>
    <a class="btn btn-light" href="index.php?controller=auth&action=login">Solicitar una cita</a>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
