jQuery(document).ready(function($){



    //================================================
    //========  slider Galerie dans single page
    //================================================

    //========  récupérer les paramètres de l'url
    //================================================
    function $_GET(param) {
        let vars = {};
        window.location.href.replace( location.hash, '' ).replace(
            /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
            function( m, key, value ) { // callback
                vars[key] = value !== undefined ? value : '';
            }
        );
        if ( param ) {
            return vars[param] ? vars[param] : null;
        }

        return vars;
    }

    let param = $_GET();

    //========  redirige vars une nouvelle page avec les bon parametre de largeur d'écran
    //================================================
    $(window).resize(function(){
        let width = $(window).width();
        param.Largeur = width;
        console.log(param);
        let url = 'http://' + window.location.hostname + window.location.pathname;
        document.location.href =  url+ "?r=" + param.r +'&Largeur='+ param.Largeur +'&Page='+ param.Page;
    });


    //========  récupère le nb de post et nb de post par page
    //========  pour calculer la dernière page
    //================================================
    let dernierePage = '';
    let nbPosts = $('#nbPosts').val();
    let nbPostsParPage = $('#nbPostsParPage').val();
    if((nbPosts%nbPostsParPage)=== 0){
        dernierePage = nbPosts/nbPostsParPage;
    }else{
        dernierePage = (Math.trunc(nbPosts/nbPostsParPage))+1;
    }



    //========  faire a pparaitre les bon bouton de contrle des page en fonction de la taille d'écran :
    //========  boutons sur le côté ou en dessous
    //================================================
    if(param.Largeur < 700 ){
        $('.prec').css('display', 'none');
        $('.suiv').css('display', 'none');
        $('.prec700').css('display', 'block');
        $('.suiv700').css('display', 'block');
    }
    if(param.Largeur > 700 ){
        $('.prec').css('display', 'block');
        $('.suiv').css('display', 'block');
        $('.prec700').css('display', 'none');
        $('.suiv700').css('display', 'none');
    }

    //========  désactivation des bouton suivant la dernière ou première page
    //================================================
    if(!param.Page || param.Page === '1'){
        $('.prec').css('color', '#3A3A3A');
        $('.prec').prop("disabled",true);
    }

    if(param.Page === String(dernierePage)){
        $('.suiv').prop("disabled",true);
        $('.suiv').css('color', '#3A3A3A');
    }


    //========  gestion des clic de changemant de page galerie
    //================================================

    $('.suivant').click(function(){

        if(param.Page){
            let pages = {'1':2,'2':3, '3':4, '4':5, '5':6, '6':7, '7':8, '8':9, '9':10, '10':11, '11':12, '12':13, '13':14, '14':15, '15':16,'16':17,'17':18,'18':19,'19':20,};
            let pageSuivante = pages[param.Page];
            let url = 'http://' + window.location.hostname + window.location.pathname;
            console.log(param);
            document.location.href =  url+ "?r=" + param.r +'&Largeur='+ param.Largeur +'&Page='+ pageSuivante+'#slideGalerie';
        }
        else{
            document.location.href = document.location.href+'&Page=2#slideGalerie';
        }

    });

    $('.precedent').click(function(){

        if(param.Page && param.Page !== '1'){
            let pages = {'2':1, '3':2, '4':3, '5':4, '6':5, '7':6, '8':7, '9':8, '10':9, '11':10, '12':11, '13':12, '14':13, '15':14,'16':15,'17':16,'18':17,'19':18,};
            let pageSuivante = pages[param.Page];
            let url = 'http://' + window.location.hostname + window.location.pathname;
            console.log(param);
            document.location.href =  url+ "?r=" + param.r +'&Largeur='+ param.Largeur +'&Page='+ pageSuivante+'#slideGalerie';
        }

        if(!param.Page || param.Page === '1'){
            param.Page = '1';
            let url = 'http://' + window.location.hostname + window.location.pathname;
            document.location.href =  url+ "?r=" + param.r +'&Largeur='+ param.Largeur +'&Page='+ param.Page+'#slideGalerie';
        }

    });




});
