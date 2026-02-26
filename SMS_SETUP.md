# SMS Configuration Setup Guide

## Overview
Your application uses a multi-provider SMS system with automatic fallback to ensure reliable message delivery in the UAE.

## Provider Priority
1. **Vonage** (Primary) - Global coverage with good UAE delivery
2. **Unifonic** (Fallback) - UAE-focused provider for better local delivery
3. **Twilio** (Fallback) - Global provider as final fallback

## Environment Variables

Add these variables to your `.env` file:

```env
# SMS Configuration
SMS_PROVIDER=vonage

# Vonage SMS Configuration (Primary)
VONAGE_KEY=your_vonage_api_key
VONAGE_SECRET=your_vonage_api_secret
VONAGE_SMS_FROM=PLATE35

# Unifonic SMS Configuration (Fallback for UAE)
UNIFONIC_APP_ID=your_unifonic_app_id
UNIFONIC_SENDER_ID=PLATE35

# Twilio SMS Configuration (Fallback)
TWILIO_SID=your_twilio_account_sid
TWILIO_TOKEN=your_twilio_auth_token
TWILIO_FROM=your_twilio_phone_number
```

## How to Get Vonage Credentials

1. **Sign up for Vonage**: Go to https://developer.vonage.com/
2. **Create an account** and verify your identity
3. **Get your API Key and Secret**:
   - Go to Dashboard → Settings → API settings
   - Copy your `API Key` (use as `VONAGE_KEY`)
   - Copy your `API Secret` (use as `VONAGE_SECRET`)
4. **Set your Sender ID**: Use `PLATE35` or your approved sender ID

## How to Get Unifonic Credentials (Optional but Recommended for UAE)

1. **Sign up for Unifonic**: Go to https://www.unifonic.com/
2. **Create an account** (focus on UAE/GCC region)
3. **Get your App ID**:
   - Go to Dashboard → API → Apps
   - Copy your `AppSid` (use as `UNIFONIC_APP_ID`)
4. **Set your Sender ID**: Use `PLATE35` or register your brand name

## Testing Your Configuration

Run this command to test your SMS setup:

```bash
# Test configuration only
php artisan sms:test

# Test configuration and send actual SMS
php artisan sms:test --phone=+971501234567
```

## Configuration Status

The system will automatically:
- ✅ Try Vonage first
- ✅ Fallback to Unifonic if Vonage fails
- ✅ Fallback to Twilio if both fail
- ✅ Use log provider in development mode
- ✅ Mask phone numbers in logs for privacy
- ✅ Provide detailed error logging

## Important Notes

1. **Sender ID Approval**: For production use, register `PLATE35` as your sender ID with providers
2. **Rate Limiting**: The system has built-in rate limiting (5/hour, 20/day per number)
3. **Phone Format**: All numbers are automatically formatted to UAE international format (+971...)
4. **Privacy**: Phone numbers are masked in logs (e.g., +971****1234)

## Troubleshooting

### Common Issues:

1. **"Provider not configured"**
   - Check your environment variables are set correctly
   - Restart your application after adding env vars

2. **"SMS failed"**
   - Check your account balance with the provider
   - Verify sender ID is approved
   - Check logs for detailed error messages

3. **"All providers failed"**
   - Verify at least one provider is properly configured
   - Check network connectivity
   - Review provider account status

### Debug Commands:

```bash
# Check current configuration
php artisan sms:test

# Clear config cache
php artisan config:clear

# View recent logs
php artisan log:show --filter=SMS
```

## Security Considerations

- Never commit your `.env` file with real credentials
- Use different credentials for testing and production
- Monitor your provider usage and costs
- Set up alerts for failed SMS deliveries 