<?php
    class postService
    {
        function handleRequest($post=null)
        {
            $message = filter_input(INPUT_POST,'message');
            if ($post != null)
            {
                $post->setMessage($message);
                return $post;
            }
            return new Post(null,$message,null);
        }
    }
?>