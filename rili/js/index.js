$(function () {

//	$('#box').calendar({
//		width : 300,
//		height : 300
		//fit : true,
		//border : false,
		//firstDay : 1,
		//weeks : ['S','M','T','W','T','F','S'],
		//months : ['Jan','Feb','Mar','Apr','May','Jun', 'Jul', 'Aug','Sep', 'Oct', 'Nov', 'Dec']
		//year : 2015,
		//month : 6,
		//current : new Date(2015, 6, 1),
		/*
		formatter : function (date) {
			return '#' + date.getDate();
		}
		
		styler : function (date) {
			//if (date.getDate() == 1) {
			//	return 'background-color:#ccc';
			//}
			if (date.getDay() == 1) {
				return 'background-color:#ccc';
			}
		},
		
		validator : function (date) {
			if (date.getDay() == 1) {
				return true;
			} else {
				return false;
			}
		}
		
		onSelect : function (date) {
			alert(date);
		}
		
		onChange : function (newDate, oldDate) {
			alert(newDate + '|' + oldDate);
		}
		*/
//	});
	
//	$('#box').calendar('moveTo', new Date(2015,6,1));







$("#box").datebox({
	required:true
})


$('#dd').datebox({
//  required:true,
//  onSelect: function(date){
//		$(this).val() =getFullYear()+":"+(date.getMonth()+1)+":"+date.getDate();
//	}
});



//
});



	









