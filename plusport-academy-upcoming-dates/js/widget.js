var pp_academy_editions = {};

jQuery(document).ready(function()
{
	Handlebars.registerHelper('formatDate', function(date, options)
	{
		// 12/17/2014 8:30:00 AM
		return moment(date, 'MM/DD/YYYY hh:mm:ss a').format(options.data.root.widget.pp_academy_dateformat);
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
			'pp_academy_trainings_id': pp_academy_trainings_id,
			'pp_academy_link_to_webshop': pp_academy_link_to_webshop
		},
		dataType: 'json'
	}).done(function(data)
	{
		var compiledTemplate = Handlebars.getTemplate('edition');
		pp_academy_editions = data.getTrainingSessionListResult.SessionInfo;
		data.widget = pp_academy_widgetdata;
		var html = jQuery(compiledTemplate(data));
		html.filter('.edition.link').click(goToWebshop);

		jQuery('.pp-academy-widget .upcoming-dates').html(html);
	});
});

function goToWebshop()
{
	var edition = jQuery(this);
	var session = encodeURIComponent(JSON.stringify(pp_academy_editions[edition.data('id')]));
	var form = jQuery('<form id=\'webshoplink\' action=\''+ pp_academy_url_to_webshop +'\' method=\'POST\'><input type=\'hidden\' name=\'calendarSession\' value=\'' + session + '\'><input type=\'hidden\' name=\'calendarCatagory\' value=\'' + edition.data('cat') + '\'><input type=\'hidden\' name=\'calendarPakket\' value=\'' + edition.data('pak') + '\'><input type=\'hidden\' name=\'calendarMonth\' value=\'0\'></form>');
	form.submit();
}
