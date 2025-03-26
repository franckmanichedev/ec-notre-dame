<!-- Start Schedule Area -->
<section class="schedule">
    <div class="container">
        <div class="schedule-inner">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 ">
                    <!-- single-schedule -->
                    <div class="single-schedule first">
                        <div class="inner">
                            <div class="icon">
                                <i class="fa fa-ambulance"></i>
                            </div>
                            <div class="single-content">
                                <span>Paroisse</span>
                                <h4>Notre Dame du Rosaire</h4>
                                <p>Situé à Mambanda, notre groupe de est rattaché à la paroisse Notre Dame du Rosaire, servons avec dévotion et amour.</p>
                                <a href="#">En savoir plus sur notre paroisse<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- single-schedule -->
                    <div class="single-schedule middle">
                        <div class="inner">
                            <div class="icon">
                                <i class="icofont-prescription"></i>
                            </div>
                            <div class="single-content">
                                <span>Multilangue</span>
                                <h4>Groupe bilingue</h4>
                                <p>Valorisation du bilinguisme, tout les premiers et derniers samedi du mois nos partages sont uniquement en anglais.</p>
                                <a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- single-schedule -->
                    <div class="single-schedule last">
                        <div class="inner">
                            <div class="icon">
                                <i class="icofont-ui-clock"></i>
                            </div>
                            <div class="single-content">
                                <span>Programme</span>
                                <h4>Jours de reunion</h4>
                                <ul class="time-sidual">
                                    <li class="day">Samedi<span>15:00-18.00</span></li>
                                    <li class="day">Sunday<span>13:00-17:30</span></li>
                                    <li class="day">Samedi (Sport)<span>7:00-10.00</span></li>
                                </ul>
                                <a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/End Start schedule Area -->
<style>
    .schedule-inner .first{
        animation: move 10s ease-in-out infinite;
    }
    .schedule-inner .middle{
        animation: move 10s linear infinite;
        animation-delay: 2s;
    }
    .schedule-inner .last{
        animation: move 10s linear infinite;
        animation-delay: 1s;
    }
    @keyframes move {
        0% {transform: translateY(0);}
        20% {transform: translateY(-10px);}
        30% {transform: translateY(-20px);}
        50% {transform: translateY(-5px);}
        60% {transform: translateY(0px);}
        70% {transform: translateY(0px);}
        85% {transform: translateY(1px);}
        93% {transform: translateY(2px);}
        100% {transform: translateY(0px);}
    }
</style>