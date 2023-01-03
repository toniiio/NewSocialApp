<?php
    class postService
    {
        function handleRequest($post=null)
        {
            $message = filter_input(INPUT_POST,'message');
            $img = filter_input(INPUT_POST,'imgPic');
            if ($post != null)
            {
                $post->setMessage($message);
                return $post;
            }
            return new Post(null,$message,null,$img);
        }
    }
?>