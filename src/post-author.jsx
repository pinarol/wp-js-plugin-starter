import React from "react";
const { withSelect } = wp.data;

class PostAuthor extends React.Component {

    render() {

        console.log(this.props.author)

        const { author = {} } = this.props;

        const avatarURL = (author.avatar_urls || {})['96']

        return <div className="wp-block-wp-js-plugin-starter-post-author-block"> 
         <img src={avatarURL} />
         <p> {author.name}</p>
         </div>;
    }
}

export default withSelect( ( select ) => {
    const { getCurrentPost } = select( 'core/editor' );
    const post = getCurrentPost();
    const { getAuthors } = select('core')
    const [ author ]  = getAuthors().filter( function(element) {
        return element.id === post.author
    }  )
    
    return {
        author
    }

} )(PostAuthor)