<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR1' => true,
        '@PSR2' => true,
        '@Symfony' => true,
        '@DoctrineAnnotation' => true,
        '@PHP71Migration' => true,
        '@PHP71Migration:risky' => true,
        '@PHP70Migration' => true,
        '@PHP70Migration:risky' => true,
        'declare_strict_types' => true,
        'strict_param' => true,
        'strict_comparison' => false,
        'align_multiline_comment' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => true,
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => ['statements' => ['while', 'declare', 'do', 'for', 'foreach', 'if', 'switch', 'try']],
        'cast_spaces' => true,
        'class_attributes_separation' => true,
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'compact_nullable_typehint' => true,
        'concat_space' => ['spacing' => 'one'],
        'declare_equal_normalize' => true,
        'dir_constant' => true,
        'ereg_to_preg' => true,
        'escape_implicit_backslashes' => true,
        'linebreak_after_opening_tag' => true,
        'list_syntax' => ['syntax' => 'short'],
        'lowercase_cast' => true,
        'magic_constant_casing' => true,
        'method_chaining_indentation' => true,
        'phpdoc_separation' => true,
        'modernize_types_casting' => true,
        'no_alias_functions' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_homoglyph_names' => true,
        'no_leading_import_slash' => true,
        'no_php4_constructor' => true,
        'no_short_bool_cast' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_around_offset' => true,
        'no_trailing_comma_in_list_call' => true,
        'no_trailing_comma_in_singleline_array' => true,
        'no_unneeded_control_parentheses' => true,
        'no_unneeded_curly_braces' => true,
        'no_unneeded_final_method' => true,
        'no_unreachable_default_argument_value' => true,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_whitespace_before_comma_in_array' => true,
        'no_whitespace_in_blank_line' => true,
        'normalize_index_brace' => true,
        'return_type_declaration' => true,
        'trim_array_spaces' => true,
        'unary_operator_spaces' => true,
        'whitespace_after_comma_in_array' => true,
        'yoda_style' => ['equal' => true, 'identical' => true, 'always_move_variable' => true],
        'ordered_imports' => true,
        'ordered_class_elements' => true,
        'no_superfluous_elseif' => true,
        'no_null_property_initialization' => true,
        'no_closing_tag' => true,
        'class_keyword_remove' => false,
        'self_accessor' => false,
        'encoding' => true,
        'full_opening_tag' => true,
        'heredoc_to_nowdoc' => true,
        'mb_str_functions' => false,
        'fully_qualified_strict_types' => true,
        'global_namespace_import' => true,
        'phpdoc_align' => [
            'tags' => [
                'param', 'return', 'throws', 'type', 'var'
            ],
        ],
        'phpdoc_to_comment' => false,
        'no_trailing_whitespace' => true,
    ])
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setUsingCache(true)
    ->setHideProgress(false)
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in([__DIR__.'/src'])
            ->name('*.php')
    );