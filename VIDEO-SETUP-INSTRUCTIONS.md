# Video Setup Instructions

## Step 1: Upload the .htaccess File

1. Open your FTP client or cPanel File Manager
2. Navigate to: `public_html/offers/video/` (or wherever your video is stored)
3. Upload the file `.htaccess-video` from this project
4. **IMPORTANT:** Rename it to `.htaccess` (remove the `-video` suffix)

## Step 2: Verify File Permissions

Make sure the following permissions are set:

```
Directory: offers/video/     → 755 (rwxr-xr-x)
File: .htaccess              → 644 (rw-r--r--)
File: lead-4-final.mp4       → 644 (rw-r--r--)
```

## Step 3: Test the Video

After uploading, test the video URL directly in your browser:

```
https://pillowpotion.com/offers/video/lead-4-final.mp4
```

### Expected Result:
- The video should either play directly in the browser OR
- It should start downloading (both are fine)

## Step 4: Check Your Server

If the video still doesn't work, you may need to:

### A. Enable mod_headers (Apache)
Contact your hosting provider or run:
```bash
sudo a2enmod headers
sudo service apache2 restart
```

### B. Enable mod_mime (Apache)
```bash
sudo a2enmod mime
sudo service apache2 restart
```

### C. Check if .htaccess is enabled
In your main Apache config, ensure:
```apache
AllowOverride All
```

## Step 5: Alternative Solutions

If .htaccess doesn't work on your server:

### Option A: Use a Different File Name
Sometimes servers block files starting with dots. Try:
- Renaming `.htaccess` to `htaccess.txt`
- Contact your host to enable .htaccess support

### Option B: Server-Level Configuration
Contact your hosting provider and ask them to:
1. Enable CORS headers for the /offers/video/ directory
2. Set proper MIME types for video files
3. Enable range requests for video streaming

### Option C: Use a CDN
Upload the video to:
- Cloudflare R2
- AWS S3
- Bunny CDN
- Any other CDN service

## Troubleshooting

### Error: "Access Denied"
- Check file permissions (644 for files, 755 for directories)
- Verify .htaccess is named correctly (no .txt extension)

### Error: "MIME type mismatch"
- The .htaccess MIME type section should fix this
- If not, contact your host

### Error: "CORS policy"
- The .htaccess CORS section should fix this
- May need to be set at server level

### Video shows "Error loading video"
1. Open browser console (F12)
2. Check the Network tab
3. Look for the video request
4. Check the response status code:
   - 200: Success (video should work)
   - 403: Access denied (permission issue)
   - 404: File not found (wrong path)
   - 500: Server error (check .htaccess syntax)

## Need Help?

If you're still having issues, provide:
1. The exact error message from browser console
2. Your hosting provider name
3. The HTTP status code when accessing the video URL
