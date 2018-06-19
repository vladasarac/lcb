$(document).ready(function(){
    
    //ako postoji div .alert uklanjamo ga posle 5 sec.
    $('.alert').delay(5000).fadeOut('slow');

//----------------------------------------------------------------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------------------------------------------------------------

    //funkcija scrolluje do diva tj elementa koji se da kao argument
    function scroll(divname){
  		$('html, body').animate({
    		scrollTop: ($(divname).first().offset().top)
    	} ,150);
    }

//----------------------------------------------------------------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------------------------------------------------------------
	
	//funkcija salje AJAX metodu postdata() PostsControllera koji salje podatke posta ciji je id dobio i onda se popunjava forma za dodavanje -
	//posta tim podatcima i menja se u fromu za edit posta
    function getpostdata(url, postid, token){
		$('#postid').remove();//uklanjamo hidden input postid ako je prethodno menjan neki post
		$('.naslovforme').text('Izmeni Post');//menjamo naslov forme
		$('.formapost').attr('action', homeurl + '/editpost');//menjamo action forme		
		$('#submitbtn').text('Izmeni');
    	$.ajax({ 
		    method: 'POST',
		    url: url,
		    data: { postid: postid, _token: token }
		})
		.done(function(o){
			console.log(o);
			var out = '<input type="hidden" id="postid" name="postid" value="' + o.post.id + '">';
			$(out).insertBefore('.posttitleinput');//dodajemo hidden input u formu sa id-em posta koju menjamo
			$('#category option[value = ' + o.post.category_id + ']').attr('selected', 'selected');
			$('#title').val(o.post.title);//ubacujemo u input za naslov title posta koji se edituje
			$('#tekst').text(o.post.content);
			scroll('.naslovforme');//scrollujemo na vrh forme
			var out2 = '<button id="cancel" class="btn btn-danger">Odustani</button>';
			$('#extrabtn').html(out2);//pravimo btn za Cancel izmene
		});	
    }

//----------------------------------------------------------------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------------------------------------------------------------
	
	//ako postoji oldpost, znaci da nije prosla validacija kad se radio edit posta pa opet zovemo funkciju getpostdata() da popuni formu
	if(oldpostid){
		getpostdata(postdataurl, oldpostid, token);
	}

//----------------------------------------------------------------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------------------------------------------------------------
	
	//klik na btn 'Izmeni' u index.blade.php iz foldera 'lcbtest\resources\views\posts' za rad sa kategorijama
	$('body').on('click', '.izmenibtn', function(){
		var postid = $(this).attr('postid'); //uzimamo id kategorije
		$('.postinput').removeClass('has-error');
		$('.help-block').remove();//uklanjamo help-block ako postoji(prikazuje errore koje vraca validacija)
		getpostdata(postdataurl, postid, token);
	});

//----------------------------------------------------------------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------------------------------------------------------------

    //klik na btn Cancel kad odustanemo od Edita nekog posta
    $('body').on('click', '#cancel', function(e){
    	e.preventDefault();
    	$(this).remove();
    	$('.naslovforme').text('Dodaj Članak');//menjamo naslov forme
    	$('.formapost').attr('action', homeurl + '/addpost');//menjamo action forme
    	$('#postid').remove();//uklanjamo hidden input sa id-em posta koji se editovao
    	$('option:selected').removeAttr('selected');//deselctujemo kategoriju
    	$('#title').val('');//praznimo text input za naslov teksta
    	$('#tekst').text('');//praznimo textarea i vracamo placeholder
    	$('#tekst').attr('placeholder', 'Ovde dodajte vaš tekst...');
    	$('#categoryid').remove();//uklanjamo hidden polje category_id
    });

//----------------------------------------------------------------------------------------------------------------------------------------------  
//----------------------------------------------------------------------------------------------------------------------------------------------
	
	//klik na btn za brisanje posta prvo izbacuje confirm
    $('body').on('click', '.obrisibtn', function(e){
    	if(!confirm("Da li ste sigurni da želite da obrišete ovaj članak?")){      
	    	e.preventDefault();
	    }
    });
});