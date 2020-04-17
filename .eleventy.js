const { DateTime } = require("luxon");
const pluginRss = require("@11ty/eleventy-plugin-rss");
const pluginSyntaxHighlight = require("@11ty/eleventy-plugin-syntaxhighlight");
const pluginNavigation = require("@11ty/eleventy-navigation");
const pluginSass = require('eleventy-plugin-sass');
const markdownIt = require("markdown-it");


module.exports = function(eleventyConfig) {
    eleventyConfig.addPlugin(pluginRss);
    eleventyConfig.addPlugin(pluginSyntaxHighlight);
    eleventyConfig.addPlugin(pluginNavigation);
    eleventyConfig.addPlugin(pluginSass);

    eleventyConfig.setDataDeepMerge(true);

    /* Markdown Overrides */
    let markdownLibrary = markdownIt({
        html: true,
        breaks: true,
        linkify: true
    });
    eleventyConfig.setLibrary("md", markdownLibrary);

    eleventyConfig.addFilter("readableDate", dateObj => {
        return DateTime.fromJSDate(dateObj, {zone: 'utc'}).toFormat("dd LLL yyyy");
    });

    // https://html.spec.whatwg.org/multipage/common-microsyntaxes.html#valid-date-string
    eleventyConfig.addFilter('htmlDateString', (dateObj) => {
        return DateTime.fromJSDate(dateObj, {zone: 'utc'}).toFormat('yyyy-LL-dd');
    });

    eleventyConfig.addCollection("tagList", require("./_11ty/getTagList"));

    eleventyConfig.addPassthroughCopy("media");
    // eleventyConfig.addPassthroughCopy("css");

    return {
        templateFormats: [
            "md",
            "njk",
            "html",
            "liquid"
        ],

        markdownTemplateEngine: "liquid",
        htmlTemplateEngine: "njk",
        dataTemplateEngine: "njk",

        // These are all optional, defaults are shown:
        dir: {
            input: ".",
            includes: "_includes",
            "layouts": "_includes/layouts",
            data: "_data",
            output: "_site"
        }
    };
};
