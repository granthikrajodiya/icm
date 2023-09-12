
CREATE TABLE [dbo].[file_download_history](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[tenant_id] [nvarchar](255) NULL,
	[product_id] [int] NULL,
	[filename] [nvarchar](1024) NULL,
	[download_date] [datetime] NULL,
	[download_user_id] [int] NULL,
	[updated_at] [datetime] NULL,
	[created_at] [datetime] NULL,
	[created_by] [int] NULL
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[product_permissions](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[product_id] [int] NULL,
	[tenant_id] [nvarchar](255) NULL,
	[created_at] [datetime] NULL,
	[created_by] [int] NULL,
	[updated_at] [datetime] NULL
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[products](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[product_version] [nvarchar](255) NULL,
	[product_name] [nvarchar](255) NULL,
	[created_at] [datetime] NULL,
	[created_by] [int] NULL,
	[updated_at] [datetime] NULL
) ON [PRIMARY]
GO





