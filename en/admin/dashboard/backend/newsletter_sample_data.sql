-- Insert sample subscribers
INSERT INTO newsletter_subscribers (email, name, subscription_date, status, source) VALUES
('john.doe@example.com', 'John Doe', DATE_SUB(NOW(), INTERVAL 45 DAY), 'subscribed', 'website'),
('jane.smith@example.com', 'Jane Smith', DATE_SUB(NOW(), INTERVAL 40 DAY), 'subscribed', 'referral'),
('mike.wilson@example.com', 'Mike Wilson', DATE_SUB(NOW(), INTERVAL 35 DAY), 'subscribed', 'website'),
('sarah.brown@example.com', 'Sarah Brown', DATE_SUB(NOW(), INTERVAL 30 DAY), 'unsubscribed', 'website'),
('alex.johnson@example.com', 'Alex Johnson', DATE_SUB(NOW(), INTERVAL 25 DAY), 'subscribed', 'social_media'),
('emma.davis@example.com', 'Emma Davis', DATE_SUB(NOW(), INTERVAL 20 DAY), 'subscribed', 'website'),
('chris.taylor@example.com', 'Chris Taylor', DATE_SUB(NOW(), INTERVAL 15 DAY), 'subscribed', 'referral'),
('lisa.anderson@example.com', 'Lisa Anderson', DATE_SUB(NOW(), INTERVAL 10 DAY), 'subscribed', 'website'),
('david.martin@example.com', 'David Martin', DATE_SUB(NOW(), INTERVAL 5 DAY), 'subscribed', 'social_media'),
('amy.white@example.com', 'Amy White', DATE_SUB(NOW(), INTERVAL 3 DAY), 'subscribed', 'website'),
('peter.king@example.com', 'Peter King', DATE_SUB(NOW(), INTERVAL 2 DAY), 'subscribed', 'referral'),
('susan.lee@example.com', 'Susan Lee', DATE_SUB(NOW(), INTERVAL 1 DAY), 'subscribed', 'website'),
('robert.clark@example.com', 'Robert Clark', NOW(), 'subscribed', 'social_media'),
('mary.wilson@example.com', 'Mary Wilson', NOW(), 'subscribed', 'website'),
('james.taylor@example.com', 'James Taylor', NOW(), 'subscribed', 'referral');

-- Insert sample campaigns
INSERT INTO newsletter_campaigns (subject, content, send_date, status, total_recipients, opens, clicks, unsubscribes) VALUES
('Welcome to Our Newsletter!', 'Welcome to our community! We\'re excited to have you here.', DATE_SUB(NOW(), INTERVAL 30 DAY), 'sent', 1000, 750, 300, 5),
('Summer Sale Announcement', 'Don\'t miss our biggest sale of the year!', DATE_SUB(NOW(), INTERVAL 25 DAY), 'sent', 1200, 900, 450, 8),
('Monthly Newsletter - June', 'Check out our June updates and news.', DATE_SUB(NOW(), INTERVAL 20 DAY), 'sent', 1500, 1100, 600, 10),
('Special Offer Inside!', 'Exclusive deals for our subscribers.', DATE_SUB(NOW(), INTERVAL 15 DAY), 'sent', 1800, 1400, 800, 12),
('Product Launch Update', 'Introducing our newest features!', DATE_SUB(NOW(), INTERVAL 10 DAY), 'sent', 2000, 1600, 900, 15),
('Weekly Digest', 'Your weekly roundup of news and updates.', DATE_SUB(NOW(), INTERVAL 5 DAY), 'sent', 2200, 1800, 1000, 18),
('Thank You for Being with Us', 'A special thank you to our loyal subscribers.', DATE_SUB(NOW(), INTERVAL 3 DAY), 'sent', 2500, 2000, 1200, 20),
('Important Updates', 'Recent changes and improvements.', DATE_SUB(NOW(), INTERVAL 1 DAY), 'sent', 2800, 2200, 1400, 22),
('Weekend Special Newsletter', 'Exclusive weekend content inside!', NOW(), 'sent', 3000, 2400, 1600, 25),
('Upcoming Events', 'Mark your calendars!', NOW(), 'draft', 0, 0, 0, 0);

-- Insert sample campaign tracking data
INSERT INTO campaign_tracking (campaign_id, subscriber_id, opened, clicked, open_date, click_date) 
SELECT 
    c.id as campaign_id,
    s.id as subscriber_id,
    TRUE as opened,
    CASE WHEN RAND() > 0.5 THEN TRUE ELSE FALSE END as clicked,
    c.send_date + INTERVAL FLOOR(RAND() * 24) HOUR as open_date,
    c.send_date + INTERVAL FLOOR(RAND() * 48) HOUR as click_date
FROM newsletter_campaigns c
CROSS JOIN newsletter_subscribers s
WHERE c.status = 'sent'
AND s.status = 'subscribed'
LIMIT 100;

-- Insert sample subscriber preferences
INSERT INTO subscriber_preferences (subscriber_id, frequency, categories)
SELECT 
    id as subscriber_id,
    CASE 
        WHEN RAND() < 0.3 THEN 'daily'
        WHEN RAND() < 0.6 THEN 'weekly'
        ELSE 'monthly'
    END as frequency,
    JSON_ARRAY_APPEND(
        JSON_ARRAY(),
        '$',
        CASE 
            WHEN RAND() < 0.3 THEN 'news'
            WHEN RAND() < 0.6 THEN 'promotions'
            ELSE 'updates'
        END
    ) as categories
FROM newsletter_subscribers
WHERE status = 'subscribed';

-- Add some daily growth data for the past 30 days
INSERT INTO newsletter_subscribers (email, name, subscription_date, status, source)
SELECT 
    CONCAT('user', n, '@example.com') as email,
    CONCAT('User ', n) as name,
    DATE_SUB(NOW(), INTERVAL FLOOR(RAND() * 30) DAY) as subscription_date,
    'subscribed' as status,
    CASE 
        WHEN RAND() < 0.4 THEN 'website'
        WHEN RAND() < 0.7 THEN 'social_media'
        ELSE 'referral'
    END as source
FROM (
    SELECT a.N + b.N * 10 + 100 as n
    FROM (SELECT 0 AS N UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) a,
         (SELECT 0 AS N UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) b
    ORDER BY n
    LIMIT 100
) numbers; 