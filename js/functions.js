function toggleForm(form)
{
	try
	{
		var buttons = document.getElementById('form_buttons');
		var nav_items = document.getElementById('nav_items');
		var login_form = document.getElementById('login_form');
		var register_form = document.getElementById('register_form');

		if(form == 'login')
		{
			buttons.style.display = 'none'; 
			nav_items.style.display = 'none';
			login_form.style.display = 'inline-block';
		}
		else if (form == 'register')
		{
			buttons.style.display = 'none';
			nav_items.style.display = 'none';
			register_form.style.display = 'inline-block';
		}
		else if (form == 'default')
		{
			buttons.style.display = 'inline-block';
			nav_items.style.display = 'inline-block';
			register_form.style.display = 'none';
			login_form.style.display = 'none';
			document.getElementById('error_box').innerHTML = '';
		}
		else
		{
			throw 'invalidParam';
		}
	}
	catch(err)
	{
		if (err == 'invalidParam')
		{
			alert('Something just broke. This button received invalid function parameters. Try again later.');
		}
	}
}

function forumToggle(forumid)
{
	var forum = document.getElementById(forumid);
	var forumTopics = document.getElementById(forumid+'_topics');
	var forumInfo = document.getElementById(forumid+'_info');

	var currClass = forumTopics.getAttribute('class');	
	var arrows = forum.getElementsByClassName('toggle_arrow');

	if (currClass == 'hidden')
	{
		forumTopics.setAttribute('class', 'shown');
		forumInfo.setAttribute('class', 'forum_info hidden');
		for (x in arrows)
		{
			arrows[x].innerHTML = ' v '
		}
	}
	else 
	{
		forumTopics.setAttribute('class', 'hidden');
		forumInfo.setAttribute('class', 'forum_info shown');
		for (x in arrows)
		{
			arrows[x].innerHTML = ' > '
		}
	}
}
