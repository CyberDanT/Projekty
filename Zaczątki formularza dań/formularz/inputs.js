function radioClick(myRadio) {
	for (c = 0; c < document.getElementsByClassName('inputfromcalories').length; c++){
		var newValue = myRadio.value
		document.getElementsByClassName('inputfromcalories')[c].innerHTML = '<br>Dla kalorii ' + newValue;
	}
	checkDates();
}

function checkMeals(meal){
	var elements = document.getElementsByClassName(meal);
	for (i = 0; i < elements.length; i++){
		if(elements[i].style.display === 'none'){
			elements[i].style = 'display: block; margin-top: 25px';
		}else{
			elements[i].style = 'display: none;';
		}
		// style = "margin-top: 25px; pointer-events:none; background-color: #F5F5F5; color: CCC;";
	}
}

function checkDates(){
	document.getElementById('submit').disabled = true;
	document.getElementById('submitinfo').innerHTML = "";
	var Platnosc = parseInt(0);
	
	var calories = document.getElementsByName('Calories');	
	for (o = 0; o < calories.length; o++){
		if(calories[o].checked == true){
			var Kalorie = calories[o].value;
			var SumaCennika = document.getElementById('SumaCennika'+calories[o].value).value;
			var Csniadanie = document.getElementById('Csniadanie'+calories[o].value).value;
			var C2sniadanie = document.getElementById('C2sniadanie'+calories[o].value).value;
			var Cobiad = document.getElementById('Cobiad'+calories[o].value).value;
			var Cpodwieczorek = document.getElementById('Cpodwieczorek'+calories[o].value).value;
			var Ckolacja = document.getElementById('Ckolacja'+calories[o].value).value;
		}
	}
	
	var dateslist = document.getElementById('Dates').value;
	var str = dateslist.split(",");
	
	var trues = [];
	var ilosc = 0;
	
	for(p = 0; p < str.length; p++){
		
		var x = new Date(str[p]);
		
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
		
		var x = new Date(x);
		var y = new Date(y);
		
		
		if(x < y){
			ilosc = ilosc+1;
			checkChecked('sniadanie');
			checkChecked('2sniadanie');
			checkChecked('obiad');
			checkChecked('podwieczorek');
			checkChecked('kolacja');
			function checkChecked(varb){
				if(document.getElementById('input'+varb).checked == true){
					for(num = 1; num<=4; num++){
						if(document.getElementById(varb+num+str[p]).checked == true){
							var ilosc = document.getElementById("il"+varb+num+str[p]).value;
							var ilosc = parseInt(ilosc);
							Platnosc = parseInt(eval("C" + varb))*ilosc + Platnosc;
						}
					}
				}
			}
			
			checkInput('sniadanie');
			checkInput('2sniadanie');
			checkInput('obiad');
			checkInput('podwieczorek');
			checkInput('kolacja');
			function checkInput(input){	
				if(document.getElementById('input'+input).checked == true){
					for(cs=1; cs<=4; cs++){
						if(document.getElementById(input+cs+str[p]).checked == true){
							if(!trues.includes(input+str[p])){;
								trues.push(input+str[p]);
							}
						}
					}
				}else{
					trues.push(input+str[p]);
				}
			}
			document.getElementById('cena').innerHTML =  'Całkowita kwota: <p>' + Platnosc + ' PLN</p>';
		}
	}
	
	if(trues.length > 0 || ilosc > 0){
		if(trues.length == ilosc*5){
			// *5 bo tyle posiłków jest na liście
			if(document.getElementById('inputsniadanie').checked == true || document.getElementById('input2sniadanie').checked == true || document.getElementById('inputobiad').checked == true || document.getElementById('inputpodwieczorek').checked == true || document.getElementById('inputkolacja').checked == true){
				document.getElementById('submit').disabled = false;
			}else{
				document.getElementById('submit').disabled = true;
				document.getElementById('submitinfo').innerHTML = "<p>Proszę wybrać minimum jeden posiłek</p>";
			}
		}
	}
}


function getChange(x){
	var y = document.getElementById(x);
	if(y.style.display === 'none'){
		y.style.display = 'block';
	}else{
		y.style.display = 'none';
	}
}
		
document.getElementById('inputsniadanie').onchange = function(){
	checkMeals("sniadanie");
	checkDates();
}
document.getElementById('input2sniadanie').onchange = function(){
	checkMeals("2sniadanie");
	checkDates();
}
document.getElementById('inputobiad').onchange = function(){
	checkMeals("obiad");
	checkDates();
}
document.getElementById('inputpodwieczorek').onchange = function(){
	checkMeals("podwieczorek");
	checkDates();
}
document.getElementById('inputkolacja').onchange = function(){
	checkMeals("kolacja");
	checkDates();
}