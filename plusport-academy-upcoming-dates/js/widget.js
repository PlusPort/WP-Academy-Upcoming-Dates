jQuery(document).ready(function()
{
	Handlebars.registerHelper('formatDate', function(date, format)
	{
		// 12/17/2014 8:30:00 AM
		return moment(date, 'MM/DD/YYYY hh:mm:ss a').format(format);
	});

	Handlebars.getTemplate = function(name) {
		if (Handlebars.templates === undefined || Handlebars.templates[name] === undefined) {
			jQuery.ajax({
				url : pp_plugin_path + '/partials/' + name + '.handlebars',
				success : function(data) {
					if (Handlebars.templates === undefined) {
						Handlebars.templates = {};
					}
					Handlebars.templates[name] = Handlebars.compile(data);
				},
				async : false
			});
		}
		return Handlebars.templates[name];
	};

	jQuery.ajax({
		url: pp_plugin_path + "../php/endpoint.php",
		data:
		{
			'pp_academy_maxsession': pp_academy_maxsession,
			'pp_academy_trainings_id': pp_academy_trainings_id
		},
		dataType: 'json'
	}).done(function(data)
	{
		var compiledTemplate = Handlebars.getTemplate('edition');
		var html = jQuery(compiledTemplate(data));
		jQuery('.pp-academy-widget .upcoming-dates').html(html);
	});
});
