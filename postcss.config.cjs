const purgecss = require('@fullhuman/postcss-purgecss');

const isProduction = process.env.NODE_ENV === 'production';

const fontAwesomeSafelist = [
    'fa-solid',
    'fa-regular',
    'fas',
    'far',
    'fa-arrow-down-long',
    'fa-balance-scale',
    'fa-newspaper',
    'fa-arrow-right',
    'fa-chevron-left',
    'fa-chevron-right',
    'fa-location-dot',
    'fa-phone',
    'fa-envelope',
    'fa-map-marker-alt',
    'fa-clock',
    'fa-user-tie',
    'fa-calendar-alt',
    'fa-th-list',
    'fa-search',
    'fa-filter',
    'fa-plus',
    'fa-edit',
    'fa-trash-alt',
    'fa-pen-nib',
    'fa-exclamation-triangle',
    'fa-paper-plane',
    'fa-check-circle',
    'fa-gavel',
    'fa-landmark',
    'fa-briefcase',
];

module.exports = {
    plugins: [
        ...(isProduction
            ? [
                  purgecss.default({
                      content: [
                          './resources/views/**/*.blade.php',
                          './resources/js/**/*.js',
                          './app/**/*.php',
                      ],
                      defaultExtractor: (content) => content.match(/[\w-/:.%]+(?<!:)/g) || [],
                      safelist: {
                          standard: [
                              'show',
                              'collapsing',
                              'collapse',
                              'fade',
                              ...fontAwesomeSafelist,
                          ],
                      },
                  }),
              ]
            : []),
    ],
};
