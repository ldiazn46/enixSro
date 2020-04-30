USE [SRO_VT_ACCOUNT]
GO

/****** Object:  Table [dbo].[websro_inbox]    Script Date: 05/24/2013 22:11:25 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[websro_inbox](
	[Username] [varchar](50) NULL,
	[SendBy] [varchar](50) NULL,
	[Title] [varchar](50) NULL,
	[Cont] [varchar](max) NULL,
	[Date] [datetime] NULL,
	[Seen] [int] NULL,
	[ID] [int] IDENTITY(1,1) NOT NULL,
 CONSTRAINT [PK_websro_inbox] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


