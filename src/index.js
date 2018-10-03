import  PostAuthor from './post-author';

const { createElement } = wp.element;
const { registerBlockType } = wp.blocks;
const { withSelect } = wp.data;

registerBlockType("wp-js-plugin-starter/post-author-block", {
  title: "Post Author Block",
  description: "Just another Post Author Block",
  icon: "admin-users",
  category: "common",

  edit: function() {
    return <PostAuthor/>;
  },

  save: function() {
    return null;
  }

});


