const htmlTag = require('html-tag');

// This function helps transforming structures like:
//
// [{ tagName: 'meta', attributes: { name: 'description', content: 'foobar' } }]
//
// into proper HTML tags:
//
// <meta name="description" content="foobar" />

const toHtml = (tags) => (
  tags.map(({ tagName, attributes, content }) => {
    if (attributes) {
      return htmlTag(tagName, attributes, content);
    } else {
      return htmlTag(tagName, content)
    }
  }).join("")
);

// Arguments that will receive the mapping function:
//
// * dato: lets you easily access any content stored in your DatoCMS
//   administrative area;
//
// * root: represents the root of your project, and exposes commands to
//   easily create local files/directories;
//
// * i18n: allows to switch the current locale to get back content in
//   alternative locales from the first argument.
//
// Read all the details here:
// https://github.com/datocms/js-datocms-client/blob/master/docs/dato-cli.md

module.exports = (dato, root, i18n) => {

  // Add to the existing Hugo config files some properties coming from data
  // stored on DatoCMS
//   root.addToDataFile('config.toml', 'toml', {
      
//   });

  // Create a YAML data file to store global data about the site
  root.createDataFile('data/settings.yml', 'yaml', {
    name: dato.site.globalSeo.siteName,
    language: dato.site.locales[0],
    intro: dato.home.introText,
    copyright: dato.home.copyright,
    profileImage: dato.home.photo.url({ w: 200, fm: 'jpg', auto: 'compress' }),
    // iterate over all the `social_profile` item types
    socialProfiles: dato.socialProfiles.map(profile => {
      return {
        username: profile.username,
        type: profile.profileType.toLowerCase().replace(/ +/, '-'),
        url: profile.url,
        email: profile.email,
      };
    }),
    description: dato.site.entity.globalSeo.fallbackSeo.description,
  });

  // Create a `work` directory (or empty it if already exists)...
  root.directory('content/projects', dir => {
    // ...and for each of the works stored online...
    dato.projects.forEach((project, index) => {
      // ...create a markdown file with all the metadata in the frontmatter
      dir.createPost(`${project.slug}.md`, 'yaml', {
        frontmatter: {
          title: project.title,
          link: project.link,
          section: project.icon,
          description: project.seoMetaTags.filter(tag => {
            if (typeof tag.attributes !== 'undefined' && typeof tag.attributes.name !== 'undefined') {
              return tag.attributes.name === 'description';
            }
            return false;
          })[0].attributes.content,
          seoMetaTags: toHtml(project.seoMetaTags),
          categories: [project.category],
          image: project.image ? project.image.url({ w: 800, fm: 'png', auto: 'compress' }) : null,
        },
        content: project.description
      });
    });
  });

  root.createPost('content/_index.md', 'yaml', {
    frontmatter: {
      title: 'Home',
      seoMetaTags: toHtml(dato.home.seoMetaTags),
    }
  });

  root.directory('content/posts', dir => {
    // ...and for each of the works stored online...
    dato.posts.forEach((post, index) => {
      // ...create a markdown file with all the metadata in the frontmatter
      dir.createPost(`${post.slug}.md`, 'yaml', {
        frontmatter: {
          title: post.title,
          date: post.date,
          seoMetaTags: toHtml(post.seoMetaTags),
        },
        content: post.content
      });
    });
  });
};