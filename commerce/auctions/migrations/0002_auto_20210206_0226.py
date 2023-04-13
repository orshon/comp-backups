# Generated by Django 3.1.4 on 2021-02-06 00:26

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('auctions', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='bid',
            name='bidder_username',
            field=models.CharField(max_length=16),
        ),
        migrations.AlterField(
            model_name='bid',
            name='listingid',
            field=models.IntegerField(default=0),
        ),
        migrations.AlterField(
            model_name='comment',
            name='username',
            field=models.CharField(max_length=16),
        ),
        migrations.AlterField(
            model_name='listing',
            name='seller',
            field=models.CharField(max_length=16),
        ),
        migrations.AlterField(
            model_name='watchlist',
            name='username',
            field=models.CharField(max_length=16),
        ),
    ]