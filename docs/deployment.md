# AWS Cloud Deployment Architecture (Bonus Task)

**Project:** Medical Case Manager  
**Platform:** Amazon Web Services (AWS)  
**Target Environment:** High-Availability, HIPAA-compliant Medical Cloud

---

## 1. Architecture Overview

```
                      [ Route 53 (DNS) ]
                               │
                               ▼
                   [ AWS Certificate Manager ]
                               │ (HTTPS 443)
                               ▼
               [ Application Load Balancer (ALB) ]
                               │
                 ┌─────────────┴─────────────┐
                 ▼                           ▼
        [ EC2 Instance 1 ]          [ EC2 Instance 2 ]
        (Nginx + PHP-FPM 8.3)       (Nginx + PHP-FPM 8.3)
                 │                           │
                 ├───────────────────────────┤
                 ▼                           ▼
       [ Amazon RDS (MySQL) ]       [ Amazon S3 Bucket ]
       (Multi-AZ, Encrypted)        (Encrypted Medical Docs)
```

---

## 2. Infrastructure Components

### 1. Compute Layer: Amazon EC2 & Auto Scaling
- **Instances:** 2x `t3.medium` instances running Ubuntu LTS across multiple Availability Zones (AZs) behind an Application Load Balancer (ALB).
- **Web Server:** Nginx configured with PHP 8.3 FPM and OPcache enabled.
- **Worker Queues:** Supervisor daemon running `php artisan queue:work` for asynchronous tasks (notifications, reports).

### 2. Database Layer: Amazon RDS (MySQL 8.0)
- **Deployment:** Multi-AZ deployment for automatic failover.
- **Storage:** General Purpose SSD (gp3) with automated daily snapshots and 30-day point-in-time recovery.
- **Encryption:** Encryption at rest enabled using AWS Key Management Service (KMS).

### 3. Storage Layer: Amazon S3
- **Assets & Documents:** Pre-signed URLs for medical device CAD/implant attachments.
- **Security:** S3 Block Public Access enabled; server-side encryption (SSE-S3 or SSE-KMS) enforced for all objects.

### 4. Networking & Security Groups
- **VPC Subnets:**
  - *Public Subnets:* Application Load Balancer only.
  - *Private Subnets:* EC2 application instances and RDS database instances (no direct public internet access).
- **Security Groups:**
  - `ALB-SG`: Ingress ports 80 (redirect to 443) and 443 from `0.0.0.0/0`.
  - `App-SG`: Ingress port 80/443 only from `ALB-SG`.
  - `DB-SG`: Ingress port 3306 only from `App-SG`.

### 5. Secrets Management & Environment Configuration
- **AWS Secrets Manager / SSM Parameter Store:** Securely stores production `.env` variables (`APP_KEY`, `DB_PASSWORD`, API secrets).
- **Deployment Injection:** During CI/CD deployment (GitHub Actions / AWS CodeDeploy), secrets are fetched and injected into `/var/www/app/.env` with strict `chmod 600` permissions.

### 6. SSL/TLS & HTTPS Termination
- Managed TLS certificates issued via **AWS Certificate Manager (ACM)** attached to the ALB.
- HTTP traffic automatically redirected to HTTPS via ALB listener rules with TLS 1.3 enforced.
