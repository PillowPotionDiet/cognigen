# Video Upload Instructions for Hosting

## The Problem
Your hosting is pulling from git but only getting Git LFS pointer files, not the actual videos.

## Solution: Upload Videos Directly

### Step 1: Locate Your Video Files Locally
The actual video files are at:
- `e:\Auto Live Projects\cognigen\cognigen_assets\lead-4-final.mp4`
- `e:\Auto Live Projects\cognigen\ds\cognigen_assets\lead-4-final.mp4`

### Step 2: Upload via FTP/cPanel

**Using FTP (FileZilla):**
1. Connect to your hosting via FTP
2. Navigate to: `public_html/` (or wherever your site is)
3. Upload to these locations:
   ```
   public_html/cognigen_assets/lead-4-final.mp4
   public_html/ds/cognigen_assets/lead-4-final.mp4
   ```

**Using cPanel File Manager:**
1. Log into cPanel
2. Open "File Manager"
3. Navigate to your site's root directory
4. Create folders if needed: `cognigen_assets/` and `ds/cognigen_assets/`
5. Upload `lead-4-final.mp4` to both folders
6. Set permissions to 644

### Step 3: Verify Upload
After uploading, test these URLs:
- `https://yourdomain.com/cognigen_assets/lead-4-final.mp4`
- `https://yourdomain.com/ds/cognigen_assets/lead-4-final.mp4`

Both should play or download the video.

### Step 4: Clear Browser Cache
After uploading, clear your browser cache or do a hard refresh:
- Chrome/Edge: Ctrl + Shift + R
- Firefox: Ctrl + F5

## Important Notes

1. **Git LFS doesn't work with most shared hosting** - Videos need manual upload
2. **Keep videos in git** - For your local development and version control
3. **Manual upload required** - Each time you update the video, upload it again via FTP
4. **File size:** The video is 135MB - ensure your hosting allows files this size

## Alternative: Add Videos to .gitignore

If you want git to track code only and not videos:

1. Add to `.gitignore`:
   ```
   *.mp4
   cognigen_assets/lead-4-final.mp4
   ds/cognigen_assets/lead-4-final.mp4
   ```

2. Always upload videos manually via FTP

## Automation Option

Some hosting providers offer:
- **GitHub Actions** - Can deploy and handle LFS files
- **Netlify/Vercel** - Support Git LFS natively
- **Custom deployment scripts** - Can fetch LFS files during deployment

But for most shared hosting, manual FTP upload is the simplest solution.
