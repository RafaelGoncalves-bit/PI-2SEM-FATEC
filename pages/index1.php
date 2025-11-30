<?php include("../modelo/topo.html"); ?>

<style>
  /* HERO BANNER */
  .hero-banner {
    margin-top: 85px;
    background: url('../img/usados2 (3).jpeg') center/cover no-repeat;
    padding: 120px 20px;
    border-radius: 12px;
    text-align: center;
    color: white;
    font-weight: 700;
    text-shadow: 0 0 10px rgba(0,0,0,0.6);
  }

  .hero-banner h1 {
    font-size: 3rem;
    font-weight: 800;
  }

  .hero-banner p {
    font-size: 1.25rem;
    font-weight: 400;
    margin-top: 10px;
  }

  /* Sessões */
  .sessao {
    margin-top: 70px;
    margin-bottom: 70px;
  }

  .sessao h2 {
    font-weight: 800;
    color: #003b7a;
    margin-bottom: 18px;
  }

  .sessao p {
    font-size: 1.1rem;
    color: #444;
  }

  /* Ícones */
  .icone-circulo {
    width: 85px;
    height: 85px;
    border-radius: 50%;
    background: #e9f1ff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    margin-bottom: 18px;
    font-size: 40px;
    color: #003b7a;
  }

  /* CTA WhatsApp fixo */
  .whatsapp-fixo {
    position: fixed;
    bottom: 25px;
    right: 25px;
    background: #25d366;
    color: white;
    width: 65px;
    height: 65px;
    border-radius: 50%;
    font-size: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    z-index: 9999;
    transition: transform .3s;
  }

  .whatsapp-fixo:hover {
    transform: scale(1.12);
  }
</style>

<!-- ========================= HERO BANNER ========================= -->
<section class="hero-banner">
  <h1>Higienização Profissional em Araras</h1>
  <p>Cuidamos do seu estofado como se fosse nosso — segurança, qualidade e resultados visíveis.</p>
</section>

<!-- ========================= CARROSSEL ========================= -->
<div id="carouselMain" class="carousel slide container mt-5" data-bs-ride="carousel">
  <div class="carousel-inner rounded">
    <div class="carousel-item active">
      <img src="../img/usados2 (1).jpeg" class="d-block w-100 img-carousel" alt="">
    </div>
    <div class="carousel-item">
      <img src="../img/usados (1).jpeg" class="d-block w-100 img-carousel" alt="">
    </div>
    <div class="carousel-item">
      <img src="../img/usados2 (3).jpeg" class="d-block w-100 img-carousel" alt="">
    </div>
  </div>
</div>

<!-- ========================= SESSÃO QUALIDADE ========================= -->
<section class="container sessao text-center">
  <div class="icone-circulo"><i class="bi bi-stars"></i></div>
  <h2>Qualidade que Você Vê e Sente</h2>
  <p>
    Nossa prioridade é entregar um serviço de higienização que realmente transforme o ambiente da sua casa.
    Utilizamos produtos de alta performance e equipamentos profissionais que permitem uma limpeza profunda,
    removendo sujeiras invisíveis, odores, ácaros e bactérias que se acumulam ao longo do tempo.
  </p>
  <p>
    Cada serviço é realizado com atenção total aos detalhes, garantindo segurança para sua família, seus pets
    e preservando a vida útil do seu estofado. Somos reconhecidos pela dedicação, cuidado e seriedade em cada atendimento.
  </p>
</section>

<!-- ========================= SESSÃO POR QUE ESCOLHER ========================= -->
<section class="container sessao">
  <h2 class="text-center">Por que escolher a XC Limpeza?</h2>
  <div class="row text-center mt-4">
    <div class="col-md-4">
      <div class="icone-circulo"><i class="bi bi-award"></i></div>
      <h5 class="fw-bold">Profissional Especializado</h5>
      <p>
        Anos de experiência na higienização de sofás, poltronas, colchões e veículos, 
        utilizando técnicas atualizadas para entregar o máximo de eficiência em cada serviço.
      </p>
    </div>

    <div class="col-md-4">
      <div class="icone-circulo"><i class="bi bi-shield-check"></i></div>
      <h5 class="fw-bold">Segurança e Confiança</h5>
      <p>
        Trabalhamos com produtos aprovados e seguros, garantindo proteção ao tecido e eliminando microrganismos
        prejudiciais à saúde — ideal para quem tem alergias, crianças ou pets.
      </p>
    </div>

    <div class="col-md-4">
      <div class="icone-circulo"><i class="bi bi-clock-history"></i></div>
      <h5 class="fw-bold">Atendimento Pontual</h5>
      <p>
        Sabemos o quanto seu tempo é importante. Por isso, prezamos por pontualidade, agilidade e um processo organizado,
        sem bagunça, sem atrasos e com total respeito ao seu lar.
      </p>
    </div>
  </div>
</section>

<!-- ========================= SESSÃO GARANTIA ========================= -->
<section class="container sessao text-center">
  <div class="icone-circulo"><i class="bi bi-patch-check"></i></div>
  <h2>Garantia de Serviço</h2>
  <p>
    Toda higienização segue um padrão rigoroso para garantir resultados reais. 
    Aplicamos produtos profissionais, realizamos escovação profunda, extração eficiente
    e finalização com neutralização de odores. O objetivo é simples: devolver o estofado
    limpo, renovado e com aparência muito superior.
  </p>
</section>

<!-- ========================= SESSÃO PASSO A PASSO ========================= -->
<section class="container sessao">
  <h2 class="text-center">Como funciona o processo?</h2>

  <div class="row mt-4">
    <div class="col-md-6">
      <h5 class="fw-bold">1️⃣ Avaliação do Estofado</h5>
      <p>Analisamos tecido, manchas e nível de sujeira para definir o tratamento ideal.</p>

      <h5 class="fw-bold mt-4">2️⃣ Aplicação de Produto Profissional</h5>
      <p>Produtos de alta performance penetram profundamente para soltar a sujeira.</p>

      <h5 class="fw-bold mt-4">3️⃣ Escovação Detalhada</h5>
      <p>Escovas especiais removem impurezas, aumentando a eficiência da higienização.</p>
    </div>

    <div class="col-md-6">
      <h5 class="fw-bold">4️⃣ Extração Potente</h5>
      <p>Equipamentos profissionais sugam sujeira, ácaros, líquidos e resíduos profundamente.</p>

      <h5 class="fw-bold mt-4">5️⃣ Secagem e Finalização</h5>
      <p>Finalizamos com alinhamento das fibras e neutralizador de odores. Resultado: tecido renovado.</p>

      <h5 class="fw-bold mt-4">6️⃣ Garantia XC</h5>
      <p>Compromisso com qualidade e resultado. Sua satisfação é prioridade.</p>
    </div>
  </div>
</section>

<?php include("../modelo/rodape.html"); ?>

<!-- CTA WhatsApp fixo -->
<a href="https://wa.me/5519998566099" target="_blank" class="whatsapp-fixo">
  <i class="bi bi-whatsapp"></i>
</a>
