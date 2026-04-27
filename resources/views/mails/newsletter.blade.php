<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Newsletter</title>
</head>

<body style="margin:0; padding:0; background:#f5f5f5; font-family: Arial, sans-serif; ">

    <div
        style="max-width:600px; margin:30px auto; background:#ffffff; padding:20px; border-radius:8px; border:1px solid #ddd;">

        <!-- Header -->
        <h2 style="text-align:center; color:#333; margin-bottom:10px;">
            📰 Latest News
        </h2>

        <p style="color:#555; font-size:14px;">
            Hello,<br>
            Here are the latest updates from our website:
        </p>

        <!-- Posts -->
        @foreach ($posts as $post)
            <div style="margin-bottom:20px; padding-bottom:10px; border-bottom:1px solid #eee;">

                <a href="{{ route('front.post', $post) }}"
                    style="text-decoration:none; color:#000; font-size:16px; font-weight:bold;">
                    {{ $post->title }}
                </a>

                <p style="color:#666; font-size:14px; margin:5px 0;">
                    {{ $post->summary }}
                </p>

                <!-- زر قراءة -->
                <a href="{{ route('front.post', $post) }}"
                    style="display:inline-block; margin-top:5px; padding:6px 12px; background:#000; color:#fff; text-decoration:none; font-size:12px; border-radius:4px;">
                    Read More
                </a>

            </div>
        @endforeach

        <!-- Footer -->
        <p style="font-size:12px; color:#888; margin-top:20px;">
            You are receiving this email because you subscribed to our newsletter.
        </p>

        <p style="font-size:12px; color:#888; margin-bottom: 2rem;">
            If you no longer wish to receive these emails,
            
            <a onclick="return confirm('Are you sure you want to unsubscribe?');" href="{{ $unsubscribeLink  }}" style="color:#000;">
                click here to unsubscribe
            </a>.
        </p>

    </div>

</body>

</html>
