function btnComprarCurso() {
    gtag('event', 'progress', {
        'event_category': 'curso',
        'event_label': 'Comprar Curso'
    });
}

function btnAbrirCurso(titulo_curso) {
    gtag('event', 'progress', {
        'event_category': 'curso',
        'event_label': 'Curso: '+titulo_curso
    });
}

function btnAssinarPlano() {
    gtag('event', 'progress', {
        'event_category': 'curso',
        'event_label': 'Assinar Plano'
    });
}

function btnMatricularSe() {
    gtag('event', 'checkout', {
        'event_category': 'curso',
        'event_label': 'Matricule-se'
    });
}

function btnAvancarFormPagamento(){
    gtag('event', 'checkout', {
        'event_category': 'curso',
        'event_label': 'Avançar Formulário'
    });
    
    fbq('track', 'InitiateCheckout');
}

function btnFinalizarCompra(){
    gtag('event', 'LastCheckout', {
        'event_category': 'curso',
        'event_label': 'Finalizar Compra'
    });

     fbq('track', 'Purchase');
}

function btnFinalizarCarrinho(){
    gtag('event', 'Carrinho', {
        'event_category': 'curso',
        'event_label': 'Finalizar'
    });
}

