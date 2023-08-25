import Link from "next/link"

export default function PostCard ({ post }){
    return (
        <Link href={post.uri} className={"card"} legacyBehavior >
            <a className="card">
                <h3>{post.title} &rarr;</h3>
            </a>
        </Link>
    )
}