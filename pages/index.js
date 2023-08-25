import Head from "next/head"
import { client } from '../lib/apollo';
import { gql } from "@apollo/client";
import PostCard from "@/components/PostCard";
export default function Home({ posts }) {
  return (
    <div className="container">
      <Head>
        <title>Headless WP Next Starter</title>
        <link rel="icon" href="favicon.ico"></link>
      </Head>

      <main className="bg-green-500">

        <h1 className="title text-3xl font-bold underline bg-green">
          Headless WordPress Next.js Starter
        </h1>
        <p className="description">
          Get started by editing <code>pages/index.js</code>
        </p>

        <div className="grid">
          {
            posts.map((post) => {
              return (
                <PostCard key={post.id} post={post}></PostCard>
              )
            })
          }
        </div>
      </main>

    </div>
  )
}



export async function getStaticProps() {

  const GET_POSTS = gql`
    query AllPostsQuery {
      posts {
        nodes {
          title
          content
          date
          uri
        }
      }
    }
  `;
  const response = await client.query({
    query: GET_POSTS
  });
  const posts = response?.data?.posts?.nodes;
  return {
    props: {
      posts
    }
  }
}