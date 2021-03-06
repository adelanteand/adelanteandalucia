module.exports = {
  'extends': 'stylelint-config-standard-scss',
  'rules': {
    'no-descending-specificity': null,
    'no-empty-source': null,
    'string-quotes': 'double',
    'no-invalid-position-at-import-rule': null,
    'selector-class-pattern': null,
    'color-function-notation': null,
    'at-rule-no-unknown': [
      true,
      {
        'ignoreAtRules': [
          'extend',
          'at-root',
          'debug',
          'warn',
          'error',
          'if',
          'else',
          'for',
          'each',
          'while',
          'mixin',
          'include',
          'content',
          'return',
          'function',
          'tailwind',
          'apply',
          'responsive',
          'variants',
          'screen',
          'use',
        ],
      },
    ],
  },
};
