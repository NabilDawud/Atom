@extends('front.master')

@section('title', 'Post')
@section('navbar', 'bg-primary')

@section('content')

    <div>
        <div class="container py-6 md:py-10">
            <div class="mx-auto max-w-4xl">
                <div class="">
                    <h1 class="pt-5 font-body text-3xl font-semibold text-primary sm:text-4xl md:text-5xl xl:text-6xl">
                        How to become a frontend developer
                    </h1>
                    <div class="flex items-center pt-5 md:pt-10">
                        <div>
                            <img src="{{ asset('Aassets/img/blog-author.jpg') }}"
                                class="h-20 w-20 rounded-full border-2 border-grey-70 shadow" alt="author image" />
                        </div>
                        <div class="pl-5">
                            <span class="block font-body text-xl font-bold text-grey-10">By Christy
                                Smith</span>
                            <span class="block pt-1 font-body text-xl font-bold text-grey-30">February 27,
                                2022</span>
                        </div>
                    </div>
                </div>
                <div class="prose max-w-none pt-8">
                    <h2 id="lorem-ipsum-dolor-sit-amet">Lorem ipsum dolor sit amet</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
                        sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                        est laborum.</p>

                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                        architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                        sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione
                        voluptatem sequi nesciunt. Neque porro quisquam est. Ut enim ad minima veniam, quis
                        nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
                        consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam
                        nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla
                        pariatur?</p>

                    <h3 id="lorem-ipsum-dolor-sit-amet-1">Lorem ipsum dolor sit amet</h3>

                    <p>Possent quippe. Conata fera ab Hersilie iam auditur haesit. Culpa ignis retia Aonides
                        ictus crescendo micantes, petere, ambustaque vicem in digitos iubet cornigeris.</p>

                    <ul>
                        <li>Iura demens satus vino simulac celanda</li>
                        <li>Exhibuere frustra utque</li>
                        <li>Iura demens satus vino simulac celanda</li>
                        <li>Exhibuere frustra utque</li>
                        <li>Panda pars umidus</li>
                    </ul>

                    <h4 id="lorem-ipsum-dolor-sit-amet-2">Lorem ipsum dolor sit amet</h4>

                    <p>Possent quippe. Conata fera ab Hersilie iam auditur haesit. Culpa ignis retia Aonides
                        ictus crescendo micantes, petere, ambustaque vicem in digitos iubet cornigeris.</p>

                    <div class="language-plaintext highlighter-rouge">
                        <div class="highlight">
                            <pre class="highlight"><code>fonts.forEach(font =&gt; {
  const { id, name, likes } = font;
  if (
    likes &gt;= 30
    || (likes === 50 &amp;&amp; likes != 0)
    || favorites[id]
  ) {
    coolFonts++;
    console.log(`${name} is cool!`);
  }
});
</code></pre>
                        </div>
                    </div>

                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                        architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas
                        sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione
                        voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit
                        amet, consectetur, adipisci velit.</p>
                </div>
                <div class="flex pt-10">
                    <a href="/"
                        class="rounded-xl bg-primary px-4 py-1 font-body font-bold text-white hover:bg-grey-20">Frontend</a>
                    <a href="/"
                        class="ml-2 block rounded-xl bg-primary px-4 py-1 font-body font-bold text-white hover:bg-grey-20">Design</a>
                </div>
                <div class="mt-10 flex justify-between border-t border-lila py-12">
                    <a href="/" class="flex items-center">
                        <i class="bx bx-left-arrow-alt text-2xl text-primary"></i>
                        <span class="block pl-2 font-body text-lg font-bold uppercase text-primary md:pl-5">Previous
                            Post</span>
                    </a>
                    <a href="/" class="flex items-center">
                        <span class="block pr-2 font-body text-lg font-bold uppercase text-primary md:pr-5">Next
                            Post</span>
                        <i class="bx bx-right-arrow-alt text-2xl text-primary"></i>
                    </a>
                </div>
                <div
                    class="flex flex-col items-center border-t border-lila py-12 pt-12 md:flex-row md:items-start xl:pb-20">
                    <div class="w-3/4 sm:w-2/5 lg:w-1/4 xl:w-1/5">
                        <img src="{{ asset('Aassets/img/blog-author.jpg') }}" class="rounded-full shadow"
                            alt="author image" />
                    </div>
                    <div class="ml-0 text-center md:ml-10 md:w-5/6 md:text-left">
                        <h3 class="pt-10 font-body text-2xl font-bold text-secondary md:pt-0">
                            Christy Smith
                        </h3>
                        <p
                            class="pt-5 font-body text-lg leading-8 text-secondary sm:leading-9 md:text-xl md:leading-9 lg:leading-9 xl:leading-9">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                            irure dolor in reprehenderit in voluptate velit.

                        </p>
                        <div class="flex items-center justify-center pt-5 md:justify-start">
                            <a href="/">
                                <i class="bx bxl-facebook-square text-2xl text-primary hover:text-yellow"></i>
                            </a>
                            <a href="/" class="pl-4">
                                <i class="bx bxl-twitter text-2xl text-primary hover:text-yellow"></i>
                            </a>
                            <a href="/" class="pl-4">
                                <i class="bx bxl-dribbble text-2xl text-primary hover:text-yellow"></i>
                            </a>
                            <a href="/" class="pl-4">
                                <i class="bx bxl-linkedin text-2xl text-primary hover:text-yellow"></i>
                            </a>
                            <a href="/" class="pl-4">
                                <i class="bx bxl-instagram text-2xl text-primary hover:text-yellow"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
