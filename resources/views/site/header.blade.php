<div class="bd-header-area bd-header-area-four bd-header-area-six header-sticky">
    <div class="bd-header-border bd-header-spacing">
        <div class="bd-custom-container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-7 order-1 order-xl-1">
                    <div class="bd-header-logo">
                        <a href="index.html"><img src="{{ asset('assets.site/img/logo/Logo-black.png') }}" alt="logo not found"></a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-1 col-md-1 col-sm-1 col-2 order-3 order-xl-2">
                    <div class="bd-main-menu bd-main-menu-border-five">
                        <nav id="bd-mobile-menu">
                            <ul>
                                <li><a href="" class="active">Página Inicial</a></li>
                                <li><a href="contact.html">Como Funciona?</a></li>
                                <li class="menu-item-has-children"><a href="index.html">Planos</a>
                                    <ul class="sub-menu">
                                        @foreach($produtos as $produto)
                                        <li><a href="{{ url('produto') }}">{{ $produto->titulo }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="about.html">Baixe o Aplicativo</a>
                                    <ul class="sub-menu">
                                        @foreach($aplicativos as $aplicativo)
                                        <li><a href="{{ $aplicativo->link_download }}">{{ $aplicativo->titulo }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li><a href="contact.html">Suporte</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- mobile menu activation -->
                    <div class="side-menu-icon side-menu-icon-four d-xl-none text-end">
                        <button class="side-toggle"><i class="far fa-bars"></i></button>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-8 col-md-8 col-sm-8 col-3 order-2 order-xl-3">
                    <div class="bd-header-right bd-header-right-four text-end">
                        <div class="bd-header-contacts">
                            <div class="bd-header-contacts-icon">
                                <img src="{{ asset('assets.site/img/icon/chatting.png') }}" alt="Atendimento ao Cliente">
                            </div>
                            <div class="bd-header-contacts-text">
                                <span>Suporte ao Cliente</span>
                                <a href="{{ Tratamento::SetURLWhatsApp($site->whatsapp) }}" target="_blank">{{ $site->whatsapp }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>