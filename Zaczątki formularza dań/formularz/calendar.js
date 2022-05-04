jQuery(document).ready(function() {
	jQuery.fn.datepicker.dates['pl'] = {
		days: ["Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota"],
		daysShort: ["Niedz", "Pon", "Wt", "Śr", "Czw", "Pt", "Sob"],
		daysMin: ["Nd", "Pn", "Wt", "Śr", "Cz", "Pt", "So"],
		months: ["Styczeń", "Luty", "Marzeć", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"],
		monthsShort: ["Sty", "Lut", "Mrz", "Kw", "Maj", "Cz", "Lip", "Sier", "Wrz", "Paź", "Lis", "Gr"],
		today: "Dzisiaj",
		clear: "Wyczyść",
		format: "yyyy-mm-dd",
		titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
		weekStart: 1,
	};
    jQuery('#datepicker').datepicker({
        startDate: new Date(),
        multidate: true,
        format: "yyyy-mm-dd",
		clearBtn: true,
		todayHighlight: true,
        daysOfWeekHighlighted: [0, 6],
        language: 'pl'
    }).on('changeDate', function(e) {
		document.getElementById('menuinfo').innerHTML = '';
		var input = document.getElementById('Dates').value;
		if(input){
			var input = input.split(",");
			for(var i = 0; i < input.length; i++){
				
				var newdate = new Date();
				newdate.setDate(newdate.getDate() + 10);
				var dd = newdate.getDate();

				var mm = newdate.getMonth()+1; 
				var yyyy = newdate.getFullYear();
				if(dd<10) {
					dd='0'+dd;
				} 

				if(mm<10) {
					mm='0'+mm;
				} 
				newdate = yyyy+'-'+mm+'-'+dd;
				
				var x = new Date(input[i]);
				
				var x = Date.parse(x);
				var y = Date.parse(newdate);
				
				if(x > y){
					document.getElementById('menuinfo').innerHTML = '<div class="errortodays">Wybrane menu będzie zrealizowane tylko dla 10 dni od dnia dzisiejszego (do dnia '+newdate+')</div>';
					checkDates();
				}
			}
		}else{
			document.getElementById('menuinfo').innerHTML = '<div class="errortodays">Proszę wybrać datę</div>';
		}
		
		//jQuery(this).find('.input-group-addon .count').text(' Ilość wybranych dat:  ' + e.dates.length);
		var d = jQuery("#datepicker").data('datepicker').getFormattedDate('yyyy-mm-dd');
				
		document.getElementById('menu').innerHTML = "";
		
		//var selected = jQuery("#datepicker").datepicker("getDate");
		//var selected = jQuery.datepicker.formatDate('mm-dd-yy', selected);
		//var today = jQuery.datepicker.formatDate('mm-dd-yy', new Date());
		
		var str = d.split(",");
		
		jQuery( ".MealsList" ).css( "display", "none" );
				
        for(var i = 0; i < str.length; i++){
			
			var node = document.getElementById('menu');
			var text  = node.innerHTML;
								
			var x = new Date(str[i]);
			
			var newdate = new Date();
			newdate.setDate(newdate.getDate() + 10 + 1); // + dzisiaj
			var dd = newdate.getDate();

			var mm = newdate.getMonth()+1; 
			var yyyy = newdate.getFullYear();
			if(dd<10) {
				dd='0'+dd;
			} 

			if(mm<10) {
				mm='0'+mm;
			} 
			newdate = yyyy+'-'+mm+'-'+dd;

			var x = Date.parse(x);
			var y = Date.parse(newdate);

			
			if(x < y){
				document.getElementById('menu').innerHTML = text + '<div class="selectMeals" id="selectMealsFor'+str[i]+'" onclick=\'Display("'+str[i]+'");\'>'+ str[i] +'</div>';
			}
        }
		checkDates();
    });
});
function Display(t) {
  jQuery( ".MealsList" ).css( "display", "none" );
  var id = "MealsFor"+t;
  var x = document.getElementById(id);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
