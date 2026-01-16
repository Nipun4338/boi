# Boi (বই) - Online Book Marketplace

A comprehensive platform for buying and selling used books. Built with a user-first perspective to promote reading and sustainability.

## Key Features (Latest Version (09-07-2021))

1. **Secure Authentication**: Email-verified signup using SMTP/PHPMailer and MD5 password hashing.
2. **Book Management**: Users can post advertisements with rich details and image galleries (powered by UploadCare).
3. **Real-time Interaction**: Integrated chat system with seen/unseen status and online/offline user presence.
4. **Smart Search**: Advanced filtering, pagination, and sorting for finding books easily.
5. **Community**: Multi-level commenting system and wishlist functionality.
6. **Admin Dashboard**: Full control to manage users, approve/reject listings, broadcast emails, and customize site assets (sliders/banners).

## 🛠 Tech Stack

| Frontend          | Backend | Services            |
| ----------------- | ------- | ------------------- |
| HTML5, CSS3       | PHP 8.x | Vercel (Deployment) |
| Bootstrap 5       | MySQL   | UploadCare (Images) |
| JavaScript (ES6+) |         | Aiven (Database)    |
| jQuery / AJAX     |         | Google SMTP         |

## ✨ Recent Updates (Dec 2025)

### 🎨 Visual & UX Overhaul

- **Modern Hero Section**: Replaced legacy carousels with a **Netflix-style horizontal category strip** for a premium, mobile-responsive browsing experience.
- **Dynamic Seller Tools**: The "Sell" page now features a **data-driven category dropdown**, preventing error-prone manual text entry.
- **Branding Consistency**: Fixed missing favicons across 15+ pages, standardizing on the modern `favicon.svg` branding.

### 🛡 Admin Panel Upgrades

- **Robust Asset Loading**: Fixed CSS/JS loading issues on Vercel by implementing intelligent routing and trailing slash enforcement.
- **Universal Image Support**: The Admin Dashboard now seamlessly handles both **remote UploadCare URLs** and **local server paths**, ensuring no more broken images.
- **Process Improvements**: Implemented "Post-Redirect-Get" patterns to fix 404 errors during book deletion and management.

### 🚦 Workflow Enhancements

- **Pending Book Preview**: Sellers can now **view their own "Pending" books** with a helpful status banner, instead of hitting a 404 wall.
- **Custom Error Pages**: Replaced generic server errors with a polished, branded **404 Page Not Found** experience.

## 🔗 Links

- **Live Demo**: [https://boi-seven.vercel.app](https://boi-seven.vercel.app)
- **Video Demo**: [![For Details](https://img.youtube.com/vi/hw2w0dZb7EE/mqdefault.jpg)](https://youtu.be/hw2w0dZb7EE)
