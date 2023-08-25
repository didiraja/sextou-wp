import Head from 'next/head'
import { client } from '../lib/apollo';
import { gql } from "@apollo/client";

export default function SlugPage({ post }) {

  return (
    <div>
      <main>
          <div className="siteHeader">
            <h1 className="title">
                {post.title}
            </h1>
            <p>✍️  &nbsp;&nbsp;{`${post.author.node.firstName} ${post.author.node.lastName}`} | 🗓️ &nbsp;&nbsp;{ new Date(post.date).toLocaleDateString() }</p>
          </div>
            <article dangerouslySetInnerHTML={{__html: post.content}}>   
            </article>
      </main>

    </div>
  )
}

  export async function getStaticProps({ params }){
    const GET_POST = gql`
      query GetPostByURI($id: ID!) {
        post(id: $id, idType: URI) {
          title
          content
          date
          author {
            node {
              firstName
              lastName
            }
          }
        }
      }
    `
    const response = await client.query({
      query: GET_POST,
      variables: {
        id: params.uri
      }
    })
    const post = response?.data?.post
    return {
      props: {
        post
      }
    }
  }

export async function getStaticPaths(){
    const paths = []
    return {
        paths,
        fallback: 'blocking'
    }
}