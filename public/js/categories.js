$(document).ready(function(){
    
    //ako postoji div .alert uklanjamo ga posle 5 sec.
    $('.alert').delay(5000).fadeOut('slow');

//----------------------------------------------------------------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------------------------------------------------------------
	
	//klik na btn 'Izmeni' u index.blade.php iz foldera 'lcbtest\resources\views\categories' za rad sa kategorijama
	$('body').on('click', '.izmenibtn', function(){
		var cattitle = $(this).attr('cattitle'); //uzimamo title kategorije
		var catid = $(this).attr('catid'); //uzimamo id kategorije
		$('.naslovforme').text('Izmeni Kategoriju');//menjamo naslov forme
		$('.formakategorija').attr('action', homeurl + '/editcategory');//menjamo action forme
		$('.help-block').remove();//uklanjamo help-block ako postoji(prikazuje errore koje vraca validacija)
		$('.cattitleinput').removeClass('has-error');
		$('#categoryid').remove();//uklanjamo hidden polje category_id ako je prethiodno kliknut edit neke kategorije
		var out = '<input type="hidden" id="categoryid" name="categoryid" value="' + catid + '">';
		$(out).insertBefore('.cattitleinput');//dodajemo hidden input u formu sa id-em kategorije koju menjamo
		$('#kategorija').val(cattitle);//u text input ubacujemo title kategorije koju menjamo
		var out2 = '<button id="cancel" class="btn btn-danger">Odustani</button>';
		$('#extrabtn').html(out2);//pravimo btn za Cancel izmene
	});

//----------------------------------------------------------------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------------------------------------------------------------

    //klik na btn Cancel kad odustanemo od Edita neke kategorije
    $('body').on('click', '#cancel', function(e){
    	e.preventDefault();
    	$(this).remove();
    	$('.naslovforme').text('Dodaj Kategoriju');//menjamo naslov forme
    	$('.formakategorija').attr('action', homeurl + '/addcategory');//menjamo action forme
    	$('#kategorija').val('');//praznimo text input za ime kategorije
    	$('#categoryid').remove();//uklanjamo hidden polje category_id
    });

//----------------------------------------------------------------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------------------------------------------------------------

	//klik na btn za brisanje kategorije prvo izbacuje confirm
    $('body').on('click', '.obrisibtn', function(e){
    	// var catid = $(this).attr('catid'); //uzimamo id kategorije
    	if(!confirm("Da li ste sigurni da želite da obrišete ovu kategoriju?")){      
	    	e.preventDefault();
	    }
    });

//----------------------------------------------------------------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------------------------------------------------------------

});