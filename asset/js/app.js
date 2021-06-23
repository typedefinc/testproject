$.datepicker.regional['ru'] = {
	closeText: 'Закрыть',
	prevText: 'Предыдущий',
	nextText: 'Следующий',
	currentText: 'Сегодня',
	monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек'],
	dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	weekHeader: 'Не',
	dateFormat: 'dd.mm.yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['ru']);

$(document).ready(function(){
    $("#datepickerstart").datepicker();
    $("#datepickerend").datepicker();
	
	$('.add-button').click((e)=>{
		
		let dateStart = $("#datepickerstart").datepicker("getDate");
		let dateEnd = $("#datepickerend").datepicker("getDate");
		let curDate = new Date();
		if(dateStart<curDate){
			$(".fieldsstart .error").text('Дата начала меньше текущей даты');
			$(".fieldsstart .error").css('opacity',1);
		}else if(dateEnd<dateStart){
			$(".fieldsend .error").text('Дата конца меньше начальной даты');
			$(".fieldsend .error").css('opacity',1);
		}else{

		}
		
	});
});

