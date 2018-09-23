{{-- 
    Languages strings and custom variables passed to JS.
    After changing this file make sure to run:
        php artisan freescout:module-build
--}}

{{-- Global vars for JS --}}
if (typeof(Vars) == "undefined") {
	Vars = {};
}
var ModuleVars = {
    hello_world: true
};
Vars = $.extend(ModuleVars, Vars);

{{-- 
    Localized JS strings.
    Usage:
        Lang.get('messages.ajax_error');
        Lang.get('messages.ajax_error', { name: 'Joe' });
--}}
if (typeof(LangMessages) == "undefined") {
	LangMessages = {};
}
@foreach ($locales as $locale)
	var locale_messages = {
        {{-- Add here strings which you need to be translated in JS--}}
        "hello_world": "{{ __("Hello World!") }}"
	};

   	if (typeof(LangMessages["{{ $locale }}.messages"]) == "undefined") {
		LangMessages["{{ $locale }}.messages"] = {};
	}
	LangMessages["{{ $locale }}.messages"] = $.extend(locale_messages, LangMessages["{{ $locale }}.messages"]);
@endforeach

(function () {
	if (typeof(Lang) == "undefined") {
    	Lang = new Lang();
    }
    Lang.setMessages(LangMessages);
})();