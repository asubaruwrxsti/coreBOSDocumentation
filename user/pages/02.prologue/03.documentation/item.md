---
title: 'Documentation Guide'
metadata:
    description: 'Documentation woes.'
    author: 'Joe Bordes'
content:
    items:
        - '@self.children'
    limit: 5
    order:
        by: date
        dir: desc
    pagination: true
    url_taxonomy_filters: true
---

# coreBOS Documentation

![work in progress](workinprogress.png?resize=150&classes=float-right)
Documentation is a continuous and ever going, ungrateful task that
**needs to be done**. No matter how much time and care you put into it,
it is rarely used and even when it is, it is hard to understand because
who wrote it knew to much of what he was explaining :-).

As brilliantly put by [Karl Fogelin](http://www.red-bean.com/kfogel) in his book
[Producing Open Source Software](http://producingoss.com/en/getting-started.html\#documentation):

 !!! Documentation is essential. There needs to be something for people to read, even if it's rudimentary and incomplete. This falls squarely into the "drudgery" category referred to earlier, and is often the first area where a new open source project falls down. Coming up with a mission statement and feature list, choosing a license, summarizing development status---these are all relatively small tasks, which can be definitively completed and usually need not be revisited once done.

Documentation, on the other hand, is never really finished, which may be
one reason people sometimes delay starting it at all.The most insidious
thing is that documentation's utility to those writing it is the reverse
of its utility to those who will read it. The most important
documentation for initial users is the basics: how to quickly set up the
software, an overview of how it works, perhaps some guides to doing
common tasks. Yet these are exactly the things the writers of the
documentation know all too well---so well that it can be difficult for
them to see things from the reader's point of view, and to laboriously
spell out the steps that (to the writers) seem so obvious as to be
unworthy of mention.

But that isn't enough for us, so we have created this open source
documentation project called coreBOSDocs, where we will be writing
articles about the application, uploading videos and tutorials for all
those issues and hurdles you may run into.

We invite you to participate and help us create a great documentation
site for **coreBOS**, any help is welcome, from creating tickets of issues you
would like us to talk or write about, to writing those articles yourself.

So, step right in and help out with the **_coreBOS Documentation Site_**

## Writing It All Down

One of our many inspirations is the pragmatic and useful book [Producing Open Source Software](http://producingoss.com) by [Karl Fogel](http://www.red-bean.com/kfogel).

In the part of the book where he touches on documenting developer best
practices he, once again, perfectly nails the situation, so I am
basically just going to copy one paragraph I think is specially
important and redirect you there: [Writing It All Down](http://producingoss.com/en/written-rules.html)

 !!! Don't try to be comprehensive. No document can capture everything people need to know about participating in a project. Many of the conventions a project evolves remain forever unspoken, never mentioned explicitly, yet adhered to by all. Other things are simply too obvious to be mentioned, and would only distract from important but non-obvious material. For example, there's no point writing guidelines like "Be polite and respectful to others on the mailing lists, and don't start flame wars," or "Write clean, readable bug-free code." Of course these things are desirable, but since there's no conceivable universe in which they might not be desirable, they are not worth mentioning. If people are being rude on the mailing list, or writing buggy code, they're not going to stop just because the project guidelines said to. Such situations need to be dealt with as they arise, not by blanket admonitions to be good. On the other hand, if the project has specific guidelines about how to write good code, such as rules about documenting every API in a certain format, then those guidelines should be written down as completely as possible.