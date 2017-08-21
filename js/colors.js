acf.add_filter('color_picker_args', function( args, $field ){
	
	// do something to args
	args.palettes = ['#68286E', '#003B76', '#0055A5', '#007BBF', '#0D8896', '#6CB545', '#FFC600', '#E16025'];
	
	
	// return
	return args;
			
});