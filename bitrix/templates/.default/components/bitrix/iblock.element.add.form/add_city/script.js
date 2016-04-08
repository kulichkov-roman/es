var oldValue = '';
function transliterateCity()
{
	{
		var from = document.getElementById('CITY_NAME');
		var to = document.getElementById('CITY_CODE');
		if(from && to && oldValue != from.value)
		{
			BX.translit(from.value, {
				'max_len' : 100,
				'change_case' : 'L',
				'replace_space' : '_',
				'replace_other' : '_',
				'delete_repeat_replace' : true,
				'use_google' : false,
				'callback' : function(result){to.value = result; setTimeout('transliterateCity()', 250); }
			});
			oldValue = from.value;
		}
		else
		{
			setTimeout('transliterateCity()', 250);
		}
	}
}
transliterateCity()