
<!DOCTYPE html>
<html>
<head><title>Server IP</title></head>
<body>
    <h1>Your Public IP is:
    <?php
        // First try IMDSv2 (token-based)
        $token = @shell_exec("curl -s -X PUT 'http://169.254.169.254/latest/api/token' -H 'X-aws-ec2-metadata-token-ttl-seconds: 21600'");
        
        if ($token) {
            // Use the token to get the public IP
            $publicIp = @shell_exec("curl -s -H 'X-aws-ec2-metadata-token: $token' http://169.254.169.254/latest/meta-data/public-ipv4");
        } else {
            // Fallback to IMDSv1
            $publicIp = @shell_exec("curl -s http://169.254.169.254/latest/meta-data/public-ipv4");
        }

        echo $publicIp ? $publicIp : "Unavailable";
    ?>
    </h1>
     <p>Served from EC2 behind an Application Load Balancer.</p>
</body>
</html>


