<?php

declare(strict_types=1);

$customFinder = PhpCsFixer\Finder::create()
	->exclude('vendor')
	->in(__DIR__);

$config = new PhpCsFixer\Config();

return $config->setRules([
	'@PSR12'                             => true,
	'elseif'                             => true,
	'indentation_type'                   => true,
	'no_empty_comment'                   => true,
	'blank_line_before_statement'        => true,
	'no_unused_imports'                  => true,
	'no_superfluous_phpdoc_tags'         => true,
	'no_extra_blank_lines'               => true,
	'no_trailing_whitespace'             => true,
	'no_whitespace_in_blank_line'        => true,
	'no_blank_lines_after_class_opening' => true,
	'no_blank_lines_after_phpdoc'        => true,
	'method_chaining_indentation'        => true,
	'trailing_comma_in_multiline'        => true,
	'ordered_imports'                    => true,
	'native_function_casing'             => true,
	'class_reference_name_casing'        => true,
	'class_attributes_separation'        => ['elements' => ['method' => 'one']],
	'single_quote'                       => true,
	'operator_linebreak' => [
		'only_booleans' => true,
	],
	'method_argument_space' => [
		'on_multiline' => 'ensure_fully_multiline',
	],
	'binary_operator_spaces' => [
		'default'   => 'single_space',
		'operators' => [
			'='  => 'align_single_space_minimal',
			'=>' => 'align_single_space_minimal',
			'+=' => 'align_single_space_minimal',
			'-=' => 'align_single_space_minimal',
			'*=' => 'align_single_space_minimal',
		],
	],
])
	->setIndent("\t")
	->setFinder($customFinder);
