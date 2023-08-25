import { ApolloProvider } from "@apollo/client/react";
import { client } from "../lib/apollo";
import '../styles/globals.css'


export default function MyApp({ Component, pageProps }) {
  return (
      <ApolloProvider client={client}>
        <Component {...pageProps} />
      </ApolloProvider>
    )
}